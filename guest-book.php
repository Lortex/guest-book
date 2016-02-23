<div class="container">
<head>
    <title>Guest Book</title>
</head>

<body>
    <h1>Guest Book</h1>
    <header>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="text" placeholder="" />
        <br><br>
        Email: <input type="text" name="text" placeholder="" />
        <br><br>
        Comment: 
        <br><textarea rows="4" columns="100" type="text" name="text" placeholder=""></textarea>
        <br><br>
        <input type="submit">
        </form>
    </header>
    <ul><?php

        echo "<link rel='stylesheet' type='text/css' href='style.css' />";

        class Guest {
            public function __construct($name, $email) {
                $this->name = $name;
                $this->email = $email;
            }
        }

        class Comment {
            public function __construct($guest, $text) {
                $this->guest = $guest;
                $this->text = $text;
            }
        }
        $theGuest = new Guest("Wilson", "wils@gmail");
        $theComment = new Comment($theGuest, "This is a comment");
        $allComments = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                array_push($allComments, $theComment);
        }
        
        foreach ($allComments as $comment) {
                    echo "<li><p>" . $comment->text . "</p></li>";
        }
        
    ?></ul>
</body>
</div>
                        