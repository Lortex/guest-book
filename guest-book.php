<div class="container">
<head>
    <title>Guest Book</title>
    <link rel='stylesheet' type='text/css' href='style.css' />
</head>

<body>
    <h1>Guest Book</h1>
        <header>
        <form method="post">
        Name: <input type="text" name="name" placeholder="" />
        <br><br>
        Email: <input type="email" name="email" placeholder="" />
        <br><br>
        Comment: 
        <br><textarea rows="4" columns="100" type="text" name="comment" placeholder=""></textarea>
        <br><br>
        <label><input type="checkbox" name="spam" value="true" />Are you human?</label><br/><br/>
        <input type="submit">
        </form>
        </header>
    <ul>
    <?php
        // connect to database and print out all comments submitted
        $servername = getenv('IP');
        $username = getenv('C9_USER');
        $password = "";
        $database = "c9";
        $dbport = 3306;
    
        // Create connection
        $db = new mysqli($servername, $username, $password, $database, $dbport);
    
        // form handler
        if($_POST) {
            // set variables
            $name = $_POST['name'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            $spam = $_POST['spam'];
            $delete = $_POST['delete'];
            $hiddenEmail = $_POST['hiddenEmail'];
            
            //echo 'Info: ' . $name . '/' . $email . '/' . $comment . '/' . $spam . '/' . $delete . '/' . $hiddenEmail;
            
            // if this is a delete, proceed, else if this is spam - provide a warning message and return
            if(isset($delete)){
                // delete post based on hidden email
                //echo 'Delete email: ' . $hiddenEmail;
                mysqli_query($db,"DELETE FROM posts WHERE email = '".$hiddenEmail."';");
            }
            else if(!isset($spam)){
                echo 'Spam detected';
                
                // close database connection
                mysqli_close($db);
                return;
            }
            else{
                // add submission to database
                echo 'Submitting post';
                mysqli_query($db,"INSERT INTO posts (name,email,comment) VALUES ('".$name."','".$email."','".$comment."');");
            }
        }
        
        // print out all previous posts
        $result=mysqli_query($db, "SELECT * FROM posts");
        $reverseArray = array();
            
        while($row=mysqli_fetch_array($result)){
            array_unshift($reverseArray, $row);
        }
            
        foreach($reverseArray as $row){
            echo '<li>' . $row[0] . ' (' . $row[1] . ')<br/><br/>' . $row[2] . '<br/><br/>';
            echo "<form method='post'>";
            echo '<input type="hidden" name="hiddenEmail" value="'.$row[1].'">
                    <input type="submit" name="delete" value="Delete"></form></li>';
        }
        
        // close database connection
        mysqli_close($db);
    ?>
    </ul>
</body>
</div>
                        