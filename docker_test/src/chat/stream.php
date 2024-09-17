<?php 
    session_start();

    include "db_connection.php";
    
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');

    $i = 1;
    while($i <= 3){
        // echo "data: heijj\n\n";
        
        // Tässä pitäisi olla event-driven architecture
        // Joka lähettää käyttäjän selaimelle uuden vastauksen vain, jos
        // jotakin uutta on tapahtunut.
        // EDA ei myöskään lukitse palvelimen suoritusta samalla tavalla kuin
        // while(sleep(1));
        // Tällä hetkellä tämä toimii samalla tavalla kuin
        // selaimen polling-ominaisuus.

        // Tämä stream jatkuvasti tarkistaa tietokantaa ja
        // palauttaa uuden viestin käyttäjälle.

        $chat_id = $_SESSION["chat_id"];
        $user_id = $_SESSION["user_id"];
        $latest_id = $_SESSION["latest_id"];
        
        $query = '
            SELECT
                m.message_id,
                m.content,
                m.user_id,
                u.username,
                m.parent_message_id,
                m.sent_at
            FROM messages m
            JOIN users u ON m.user_id = u.user_id
            WHERE m.chat_id = ?
            AND m.message_id > ?
            ORDER BY m.message_id ASC
        ';
        
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $chat_id, $latest_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if(!$result){
            die("Query failed!: " . $mysqli->error);
        }
        
        // Tietokannan haku
        $messages = [];
        while($row = $result->fetch_assoc()){
            // Siirretään data taulukkoon
            $messages[] = $row;
        }
        if(count($messages) > 0){
            echo "data: " . generateReceivedMessage($message['username'], $message['content'],
            $message['parent_message_id'], $message['sent_at']) . "\n\n";
            flush();
        }

        // echo "data: " . $_SESSION["latest_id"] . "\n\n";
        echo "data: " . count($messages) . "\n\n";
        flush();
        $i++;
        sleep(1);
    }
    // 1. Tämä silmukka tapahtuu 3 kertaa.
    // 2. Palautetaan käyttäjälle 3 kertaa tietokannasta dataa
    // 3. Lopetetaan suoritus / katkaistaan yhteys
    // 4. HTMX havaitsee katkoksen ja ottaa yhteyden uudelleen
    // GOTO step 1.

?>