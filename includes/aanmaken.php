<?php
include_once 'dbh.inc.php';
if (isset($_POST['submit'])) {
    session_start();

    $userid = $_SESSION["userid"];
    if (isset($_FILES['file'])) {
        $fileName = $_FILES['file']['name'];

        if ($fileName != NULL) {
            $file = $_FILES['file'];
            print_r($file);
            die;
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 9000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = '../uploads/' . $fileNameNew;
                        $filepath = 'uploads/' . $fileNameNew;

                        move_uploaded_file($fileTmpName, $fileDestination);
                        // header("location: ../ticket-maken.php?error=nofile");
                        // exit();
                    } else {
                        header("location: ../ticket-maken.php?error=filetobig");
                        exit();
                    }
                }
            } else {
                header("location: ../ticket-maken.php?error=error");
                exit();
            }
            // } else {
            //     header("location: ../ticket-maken.php?error=wrongtype");
            //     exit();
            // }
        } else {
            $filepath = 'uploads/nofile.php';
        }


        // $kort = $_POST['korte-omschrijving'];
        // $lang = $_POST['lange-omschrijving'];
        // $prio = $_POST['prio'];
        // $toestel = $_POST['toestel'];
        // $dienst = $_POST['dienst'];
        // $date = $_POST['date'];
        // echo "Korte omschrijving " . $kort . " Lange omschrijving " . $lang . " prio " . $prio . " toestel " . $toestel . " dienst " . $dienst . " date " . $date . " userid " . $userid;

        // Het ticket uploaden naar de databank
        $kort = mysqli_real_escape_string($conn,  $_POST['korte-omschrijving']);
        $lang = $_POST['lange-omschrijving'];
        $prio = mysqli_real_escape_string($conn,  $_POST['prio']);
        $toestel = mysqli_real_escape_string($conn,  $_POST['toestel']);
        $dienst = mysqli_real_escape_string($conn,  $_POST['dienst']);
        $ticket_user_probleem = mysqli_real_escape_string($conn,  $_POST['ticket_user_probleem']);

        $date = $_POST['date'];
        // $userid = 2;
        if (empty($kort) || empty($lang) || empty($prio) || empty($toestel) || empty($dienst) || empty($ticket_user_probleem) || empty($date)) {
            header("location: ../ticket-maken.php?error=emptyinput");
        }
        // echo "Korte omschrijving " . $kort . " Lange omschrijving " . $lang . " prio " . $prio . " toestel " . $toestel . " dienst " . $dienst . " date " . $date . " userid " . $userid;
        // print_r($kort . $lang . $prio . $toestel . $dienst . $date . $userid);

        $sql = "INSERT INTO tickets (ticket_korte_omschrijving, ticket_lange_omschrijving, ticket_prioriteit, ticket_toestel, ticket_dienst, ticket_datum_gemeld, ticket_filepath, ticket_user, ticket_user_probleem) VALUES (?, ?, ?, ?, ?, '" . $date . "', ?, ?, ?)";
        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisisis", $kort, $lang, $prio, $toestel, $dienst, $filepath, $userid, $ticket_user_probleem);

        if ($stmt->execute()) {
            $newticketID = $stmt->insert_id;
        } else {
            header("location: ../ticket-maken.php?error=error");
            exit();
        }

        $stmt->close();
        $conn->close();
        header("location: ../ticket.php?id=$newticketID");
        exit();


        // $sql = "INSERT INTO tickets (ticket_korte_omschrijving, ticket_lange_omschrijving, ticket_prioriteit, ticket_toestel, ticket_dienst, ticket_datum_gemeld, ticket_filepath, ticket_user) VALUES ('$kort', '$lang', '$prio', '$toestel', '$dienst', '$date', '$filepath', '$userid');";

        // mysqli_query($conn, $sql);
        // header("location: ../tickets.php");


        // } else {
        //     header("location: ../ticket-maken.php?error=nofile");
        //     exit();
        // }
    } else {
        header("location: ../ticket-maken.php?error=error");
        exit();
    }
}
