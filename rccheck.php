<!DOCTYPE html>
<html>
<head>
	<title>Username and Password Form</title>
	<style>
        table {
		background-color: lightgrey;
  		border: 1px solid black;
  		border-spacing: 10px;

		}
        table, th, td {
      border-collapse: collapse;
    border: 1px solid black;
    padding: 10px;
    
}
    input{
        margin-top:20px;
        background-color:brown;
        color:white;
        width:100px;
    }
    label.response-label {
    margin-right: 10px;
}
.response-textbox {
    margin-right: 10px;}
.response-textbox::placeholder {
    color: white;
}
   
</style></head>
<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "example";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!(empty($_POST["action"]))){
    foreach ($_POST["action"] as $id => $status) {
        $sql = "UPDATE outpass SET status='$status'";
        $sql .= ($status == "reject" && isset($_POST["response"][$id])) ? ", response='" . mysqli_real_escape_string($conn, $_POST["response"][$id]) . "'" : "";
        $sql .= " WHERE Id='$id'";
        mysqli_query($conn, $sql);
    }}}
   

$sql = "SELECT * FROM outpass ORDER BY fromd ASC";
$result = mysqli_query($conn, $sql);
$displayActionColumn = false;
while ($row = mysqli_fetch_assoc($result)) {
    if ($row["status"] != "accept" && $row["status"] != "reject") {
        $displayActionColumn = true;
        break;
    }
}

if (mysqli_num_rows($result) > 0) {
    echo "<form method='POST' id='myForm'>";
    echo "<center>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Regn</th><th>From Date</th><th>To Date</th><th>Number of Days</th><th>Destination</th><th>Reason</th><th>Status</th><th>Response</th><th id='k'>Action</th>";
    echo "</tr>";
    mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row["Id"] . "</td>";
      echo "<td>" . $row["reg"] . "</td>";
      echo "<td>" . $row["fromd"] . "</td>";
      echo "<td>" . $row["tod"] . "</td>";
      echo "<td>" . $row["days"] . "</td>";
      echo "<td>" . $row["dest"] . "</td>";
      echo "<td>" . $row["reason"] . "</td>";
      echo "<td>" . $row["status"] . "</td>";
      echo "<td>" .$row["response"] ."</td>";
      echo "<td  id='k1'>";
      if ($row["status"] != "accept" && $row["status"] != "reject") {
          echo "<input type='radio' name='action[" . $row["Id"] . "]' value='accept' onclick='createResponseTextBox(this)'>Accept";
          echo "<input type='radio' name='action[" . $row["Id"] . "]' value='reject' onclick='createResponseTextBox(this)'>Reject";
      } else if ($row["status"] == "reject" && !empty($row["response"])) {
          echo "<input type='hidden' name='response[" . $row["Id"] . "]' value='" . htmlspecialchars($row["response"]) . "'>";
      }
      echo "</td>";
      echo "</tr>";
  }
  
    echo "</table>";
    echo "<div id='response-container'></div>";
    echo "<input type='submit' value='SUBMIT'>";
    echo "</form>";
} else {
    echo "No data found";
}


mysqli_close($conn);
?>

<script>
function createResponseTextBox(button) {
    if (button.checked && button.value === 'reject') {
        const rowId = button.parentNode.parentNode.childNodes[0].innerHTML;
        const existingResponse = document.querySelector(`input[name='response[${rowId}]']`);
        if (existingResponse) {
            existingResponse.type = 'text';
            existingResponse.required = true;
        } else {
            const textBox = document.createElement('input');
            textBox.type = 'text';
            textBox.name = `response[${rowId}]`;
            textBox.placeholder = 'Enter reason';
            textBox.required = true;
            textBox.style.width = '300px';
            textBox.style.height = '50px';
            textBox.style.textAlign = 'center';
            textBox.style.backgroundColor = 'indigo';
            textBox.classList.add('response-textbox'); // Add the 'response-textbox' class
            const idLabel = document.createElement('label');
            idLabel.innerHTML = `ID ${rowId}`;
            idLabel.setAttribute('for', `response[${rowId}]`);
            idLabel.classList.add('response-label');
            document.getElementById('response-container').appendChild(idLabel);
            document.getElementById('response-container').appendChild(textBox);
        }
        const idLabel = document.querySelector(`label[for='response[${rowId}]']`);
        if (idLabel) {
            idLabel.style.display = 'inline-block';
        }
    } else {
        const rowId = button.parentNode.parentNode.childNodes[0].innerHTML;
        const existingResponse = document.querySelector(`input[name='response[${rowId}]']`);
        if (existingResponse) {
            existingResponse.type = 'hidden';
            existingResponse.required = false;
        }
        const idLabel = document.querySelector(`label[for='response[${rowId}]']`);
        if (idLabel) {
            idLabel.style.display = 'none';
        }
    }
}
    function hidecolumn() {
    var displayActionColumn = <?php echo $displayActionColumn ? 'true' : 'false'; ?>;
    if(!displayActionColumn){
    event.preventDefault(); // prevent default form submission
    document.getElementById("k").style.display = "none";
    var actionColumn = document.querySelectorAll("#k1");
    for (var i = 0; i < actionColumn.length; i++) {
        actionColumn[i].style.display = "none";
    }}
  };
  window.onload = hidecolumn;







</script>
<br><br>
<a href="rc.html">Back</a>
</html>