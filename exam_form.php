<?php
$user_id = $_GET['user_id']; // Get the user ID from the URL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Calculate the score
    $correct_answers = array('q1' => 'a', 'q2' => 'b', 'q3' => 'c'); // Define correct answers
    $score = 0;

    foreach ($correct_answers as $question => $answer) {
        if ($_POST[$question] == $answer) {
            $score++;
        }
    }

    // Determine pass/fail result
    $result = ($score >= 9) ? "Your license will arrive in 2 days." : "Please try again after 4 days.";

    // Store the result in the database
    $conn = new mysqli("localhost", "root", "", "rto_management");
    $sql = "INSERT INTO llr_test_results (user_id, score, result) VALUES ('$user_id', '$score', '$result')";
    $conn->query($sql);
    $conn->close();

    // Display the result to the user
    echo $result;
} else {
?>
    <form action="mcq_test.php?user_id=<?php echo $user_id; ?>" method="post">
        <h2>LLR MCQ Test</h2>
        <p>1. What is the maximum speed limit in a residential area?</p>
        <input type="radio" name="q1" value="a"> 30 km/h<br>
        <input type="radio" name="q1" value="b"> 50 km/h<br>
        <input type="radio" name="q1" value="c"> 60 km/h<br>

        <p>2. Which side should you overtake from?</p>
        <input type="radio" name="q2" value="a"> Right<br>
        <input type="radio" name="q2" value="b"> Left<br>
        <input type="radio" name="q2" value="c"> Middle<br>

        <p>3. When should you use high beam lights?</p>
        <input type="radio" name="q3" value="a"> During rain<br>
        <input type="radio" name="q3" value="b"> At night on an empty road<br>
        <input type="radio" name="q3" value="c"> Always<br>

        <!-- Add more questions as needed -->
        
        <button type="submit">Submit Test</button>
    </form>
<?php
}
?>
