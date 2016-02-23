<?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $theGuest = new Guest("Wilson", "wils@gmail");
            $theComment = new Comment($theGuest, "This is a comment");
            $allComments = array();
            array_push($allComments, $theComment);
            array_push($allComments, $theComment);
        }
                    foreach ($allComments as $comment) {
                echo "<li><p>" . $comment->text . "</p></li>";
            }
?>