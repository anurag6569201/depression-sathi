<?php
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE unique_id != {$outgoing_id} ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    } elseif(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            $result = (mysqli_num_rows($query2) > 0) ? $row2['msg'] : "No message available";
            $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
            if(isset($row2['outgoing_msg_id'])){
                $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
            } else {
                $you = "";
            }
            $offline = ($row['status'] == "Offline now") ? "offline" : "";
            $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";
            
            echo '<a href="javascript:void(0);" class="user-link" data-user-id="' . $row['unique_id'] . '">';
            echo '<div class="user-info">';
            echo '<img src="ChatApp/php/images/' . $row['img'] . '" alt="">';
            echo '<span>' . '       ' . $row['fname'] . ' ' . $row['lname'] . '</span>';
            echo '</div>';
            echo '<div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>';
            echo '</a>';
        }
    }
?>
