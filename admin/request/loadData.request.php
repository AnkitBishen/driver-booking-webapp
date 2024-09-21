<?php
include("../dbConfig.php");

$checkData = json_decode(file_get_contents("php://input"));
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mailer/vendor/autoload.php';

if(!empty($checkData->getBookingData) && $checkData->getBookingData == true){
    $page = $checkData->page;
    $limit = $checkData->limit;
    $offset = ($page-1)*$limit;

    // geting total pages and records 
    $query1="SELECT tuser.userName, tbooking.`bookingID`, tbooking.`bookingDateTime`, tbooking.`userMail`, tbooking.`startDate`, tbooking.`endDate`, tbooking.`pickupTime`, tbooking.`userPhoneNo`, tbooking.`fromAdd`, tbooking.`toAdd` FROM `tblbookings` as tbooking LEFT join `tblusers` as tuser on tuser.mail = tbooking.userMail";
    $runQuery1 = mysqli_query($connection, $query1);
    $num_rows1 = mysqli_num_rows($runQuery1);
    if($num_rows1>0){
        $total_record = $num_rows1;
        $total_page = ceil($total_record / $limit);
    }else {
        $total_record=0;
        $total_page=0;
    }

    //$query="SELECT tuser.userName, tbooking.`bookingID`, tbooking.`bookingDateTime`, tbooking.`userMail`, tbooking.`startDate`, tbooking.`endDate`, tbooking.`pickupTime`, tbooking.`userPhoneNo`, tbooking.`fromAdd`, tbooking.`toAdd`, tbooking.`BookedStatus`, tbooking.`appointTo` FROM `tblbookings` as tbooking LEFT join `tblusers` as tuser on tuser.mail = tbooking.userMail ORDER by `bookingDateTime` DESC LIMIT {$offset}, {$limit}";
    $query="SELECT tuser.userName, tbooking.`bookingID`, tbooking.`bookingDateTime`, tbooking.`userMail`, tbooking.`startDate`, tbooking.`endDate`, tbooking.`pickupTime`, tbooking.`userPhoneNo`, tbooking.`fromAdd`, tbooking.`toAdd`, tbooking.`BookedStatus`, tbooking.`appointTo`,temp.empName FROM `tblbookings` as tbooking LEFT join `tblusers` as tuser on tuser.mail = tbooking.userMail LEFT join `allemployes` as temp on temp.empID = tbooking.appointTo ORDER by `bookingDateTime` DESC LIMIT {$offset}, {$limit}";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);

    $BookedData = array();
    if($num_rows>0){
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
           $BookedData[] = array("userName"=>$fetchData['userName'],"bookingID"=>$fetchData['bookingID'],"bookingDateTime"=>$fetchData['bookingDateTime'],"toAdd"=>$fetchData['toAdd'],"userMail"=>$fetchData['userMail'],"startDate"=>date("d/m/Y", strtotime($fetchData['startDate'])),"endDate"=>date("d/m/Y", strtotime($fetchData['endDate'])),"pickupTime"=>$fetchData['pickupTime'],"userPhoneNo"=>$fetchData['userPhoneNo'],"fromAdd"=>$fetchData['fromAdd'],"BookedStatus"=>$fetchData['BookedStatus'],"appointTo"=>$fetchData['appointTo'],"empName"=>$fetchData['empName']);
        }

        $status= "success";
    }else{
        $status= "failed";
    }
    echo json_encode(array("status"=>$status, "BookedData"=>$BookedData,"total_page"=>$total_page,"total_record"=>$total_record));
}
else if(!empty($checkData->declineBookingData) && $checkData->declineBookingData == true){
    $bId = $checkData->bId;
    $userMail = $checkData->userMail;
    $userName = $checkData->userName;

    // get user booking data ============
    $query = "SELECT `startDate`, `endDate`, `pickupTime`, `fromAdd`, `toAdd`,`appointTo` FROM `tblbookings` WHERE `bookingID`='$bId' and `userMail`='$userMail'";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
        $fetchData =  mysqli_fetch_assoc($runQuery);
        
        //update booking status ==============
        $query1 = "UPDATE `tblbookings` SET `BookedStatus`='rejected',`appointTo`='' WHERE `bookingID`='$bId' and `userMail`='$userMail'";
        $runQuery1 = mysqli_query($connection, $query1);

        //update driver status ==============
        if($fetchData['appointTo']!=''){
            $query12 = "UPDATE `allemployes` SET `appointed`='0' WHERE `empId`='".$fetchData['appointTo']."'";
            $runQuery12 = mysqli_query($connection, $query12);
        }
        

        if($runQuery1){
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'devsite0181@gmail.com';                     //SMTP username
                $mail->Password   = 'xyutslkvvifvsxzp';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('devsite0181@gmail.com', 'Company');
                $mail->addAddress("$userMail", "$userName");     //Add a recipient
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Important Update Regarding Your Booking';
                $mail->Body    = 'Dear '.$userName.' <br><br><br> We regret to inform you that, unfortunately, we are unable to confirm your booking form <b> '.$fetchData['fromAdd'].'</b> to <b>'.$fetchData['toAdd'].'</b> at this time. We understand that this may come as disappointing news, and we want to assure you that this decision was not made lightly.<br><br>
                Please accept our apologies for any inconvenience this may cause.<br><br><br> Thank you for considering us. <br> Company Name';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 1;  // msg send successfully
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";   // failed to send msg
            }
        }else{
            echo 3;  //failed to update status
        }
    }else{
        echo 2;   //failed to get booking data
    }
}
else if(!empty($checkData->approveBookingData) && $checkData->approveBookingData == true){
    $bId = $checkData->bId;
    $userMail = $checkData->userMail;
    $userName = $checkData->userName;
    $selectedEmp = $checkData->selectedEmp;

    // get user booking data ============
    $query = "SELECT `startDate`, `endDate`, `pickupTime`, `fromAdd`, `toAdd`,`userPhoneNo` FROM `tblbookings` WHERE `bookingID`='$bId' and `userMail`='$userMail'";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
        $fetchData =  mysqli_fetch_assoc($runQuery);

        //get appoint driver details ===========
        $queryForEmp = "SELECT empName, empPhoneNumber FROM `allemployes` where `empId`='$selectedEmp'";
        $runQueryForEmp = mysqli_query($connection, $queryForEmp);
        if($runQueryForEmp){
            $fetchDataForEmp =  mysqli_fetch_assoc($runQueryForEmp);
            if($fetchDataForEmp){
                $empName = $fetchDataForEmp['empName'];
                $empPhoneNumber = $fetchDataForEmp['empPhoneNumber'];
            }
        }
        
        //update driver status ==============
        $query3 = "UPDATE `allemployes` SET `appointed`='1' WHERE `empId`='$selectedEmp'";
        $runQuery3 = mysqli_query($connection, $query3);


        //update booking status ==============
        $query1 = "UPDATE `tblbookings` SET `BookedStatus`='approved', `appointTo`='$selectedEmp' WHERE `bookingID`='$bId' and `userMail`='$userMail'";
        $runQuery1 = mysqli_query($connection, $query1);

        //send message to driver on whatsapp
        $message = "Hi ".$empName."! You are appointed for a booking on ".$fetchData['startDate']." at ".$fetchData['pickupTime'].". Here are the details:\n- Customer Name: ".$userName."\n- Contact: ".$fetchData['userPhoneNo']."\n- Address: ".$fetchData['startDate']." to ".$fetchData['endDate']."";//\n- Additional Notes: [Any special instructions]";
        $urlEncodedMessage = urlencode($message);
        $empPhoneNumber = "+91".$empPhoneNumber;
        $send = "https://api.whatsapp.com/send?phone=$empPhoneNumber&text=$urlEncodedMessage";
        if($send){

        }else{

        }


        if($runQuery1){
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'devsite0181@gmail.com';                     //SMTP username
                $mail->Password   = 'xyutslkvvifvsxzp';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('devsite0181@gmail.com', 'Company');
                $mail->addAddress("$userMail", "$userName");     //Add a recipient
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your Booking Confirmation';
                $mail->Body    = 'Dear '.$userName.' <br><br><br> We are thrilled to inform you that your booking 
                form <b> '.$fetchData['fromAdd'].'</b> to <b>'.$fetchData['toAdd'].'</b> has been officially confirmed and our driver will get you on <b>'.date("h:i:s a", strtotime($fetchData['pickupTime'])).'</b>. It is with great pleasure that we extend our warmest gratitude to you for choosing our Service.<br><br>Here is the Driver Details :- <br> Name : '.$empName.'<br> Phone Number : '.$empPhoneNumber.' <br><br><br> Thank you <br> Company Name';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 1;  // msg send successfully
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";   // failed to send msg
            }
        }else{
            echo 3;  //failed to update status
        }
    }else{
        echo 2;   //failed to get booking data
    }

    
}
else if(!empty($checkData->ReApproveBookingData) && $checkData->ReApproveBookingData == true){
    $bId = $checkData->bId;
    $userMail = $checkData->userMail;
    $userName = $checkData->userName;
    $selectedEmp = $checkData->selectedEmp;

    // get user booking data ============
    $query = "SELECT `startDate`, `endDate`, `pickupTime`, `fromAdd`, `toAdd`,`appointTo` FROM `tblbookings` WHERE `bookingID`='$bId' and `userMail`='$userMail'";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
        $fetchData =  mysqli_fetch_assoc($runQuery);

        //get appoint driver details ===========
        $queryForEmp = "SELECT empName, empPhoneNumber FROM `allemployes` where `empId`='$selectedEmp'";
        $runQueryForEmp = mysqli_query($connection, $queryForEmp);
        if($runQueryForEmp){
            $fetchDataForEmp =  mysqli_fetch_assoc($runQueryForEmp);
            if($fetchDataForEmp){
                $empName = $fetchDataForEmp['empName'];
                $empPhoneNumber = $fetchDataForEmp['empPhoneNumber'];
            }
        }
        
        //update old driver status ==============
        if($fetchData['appointTo']!=''){
            $queryOldDriver = "UPDATE `allemployes` SET `appointed`='0' WHERE `empId`='".$fetchData['appointTo']."'";
            $runQueryOldDriver = mysqli_query($connection, $queryOldDriver);
        }
        //update new driver status ==============
        $query3 = "UPDATE `allemployes` SET `appointed`='1' WHERE `empId`='$selectedEmp'";
        $runQuery3 = mysqli_query($connection, $query3);


        //update booking status ==============
        $query1 = "UPDATE `tblbookings` SET `BookedStatus`='approved', `appointTo`='$selectedEmp' WHERE `bookingID`='$bId' and `userMail`='$userMail'";
        $runQuery1 = mysqli_query($connection, $query1);

        if($runQuery1){
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'devsite0181@gmail.com';                     //SMTP username
                $mail->Password   = 'xyutslkvvifvsxzp';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('devsite0181@gmail.com', 'Company');
                $mail->addAddress("$userMail", "$userName");     //Add a recipient
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Important Update: Change in Your Appointed Driver';
                $mail->Body    = 'Dear '.$userName.' <br><br><br> We would like to inform you about a change in your appointed driver for your upcoming service on '.$fetchData['startDate'].'. we apologize for the change in drivers, and we thank you for your understanding and flexibility..<br><br>Here is the Driver Details :- <br> Name : '.$empName.'<br> Phone Number : '.$empPhoneNumber.' <br><br><br> Thank you <br> Company Name';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 1;  // msg send successfully
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";   // failed to send msg
            }
        }else{
            echo 3;  //failed to update status
        }
    }else{
        echo 2;   //failed to get booking data
    }

    
}
else if(!empty($checkData->getEmpDriver) && $checkData->getEmpDriver == true){

    $query = "SELECT empId, empName FROM `allemployes` where `empRole`='driver' and `appointed`='0'";
    $runQuery = mysqli_query($connection, $query);
    $num_rows = mysqli_num_rows($runQuery);
    if($num_rows>0){
        $driverData= [];
        while($fetchData =  mysqli_fetch_assoc($runQuery)){
            $driverData[]= array("empId"=>$fetchData['empId'],"empName"=>$fetchData['empName']);
        }
        $status = "success";
    }else{
        $status = "failed";
    }
    echo json_encode(array("status"=>$status, "driverData"=>$driverData));
}

?>