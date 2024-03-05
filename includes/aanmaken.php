<?php
// We voegen het bestand dbh.inc.php toe
include_once 'dbh.inc.php';
// We kijken of de bezoeker op deze pagina is gekomen door het formulier te verzenden
if (isset($_POST['submit'])) {
    // We starten de sessie
    session_start();
    // We kijken naar het id van de gebruiker
    $userid = $_SESSION["userid"];
    if (isset($_FILES['file'])) {
        $fileName = $_FILES['file']['name'];
        // We kijken of er een bestand is ingediend. zo niet word het bestand dus ook niet upgeload
        if ($fileName != NULL) {
            // We halen alle informatie van het bestand op
            $file = $_FILES['file'];
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

        // We halen de gegevens op uit het formulier en doen een eerste controle op SQL injecties
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

        // We maken de sql klaar om in de databank ingegeven te worden.
        $sql = "INSERT INTO tickets (ticket_korte_omschrijving, ticket_lange_omschrijving, ticket_prioriteit, ticket_toestel, ticket_dienst, ticket_datum_gemeld, ticket_filepath, ticket_user, ticket_user_probleem) VALUES (?, ?, ?, ?, ?, '" . $date . "', ?, ?, ?)";
        // prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisisis", $kort, $lang, $prio, $toestel, $dienst, $filepath, $userid, $ticket_user_probleem);
        // We kijken of het invoeren gelukt is.
        if ($stmt->execute()) {
            $newticketID = $stmt->insert_id;
        } else {
            header("location: ../ticket-maken.php?error=error");
            exit();
        }

        $stmt->close();
        $conn->close();
        // We sturen de gebruiker naar het nieuw aangemaakte ticket
        header("location: ../ticket.php?id=$newticketID");
        exit();
    } else {
        header("location: ../ticket-maken.php?error=error");
        exit();
    }
}
