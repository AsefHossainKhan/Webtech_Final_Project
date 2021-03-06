<?php
  require_once("../db/db.php");

  function registerCoach($username, $name, $email, $password) {
    $connection = dbConnection();
    $sql = "INSERT INTO users VALUES ('','$username', '$name', '$email', 'Coach')";

    try {
      mysqli_query($connection, $sql);
      $sql2 = "SELECT userId FROM users WHERE userName='$username'";
      $result = mysqli_query($connection, $sql2);
      $row = mysqli_fetch_assoc($result);
      $userId = $row['userId'];
      $sql3 = "INSERT INTO login VALUES ('','$userId','$password','','')";
      mysqli_query($connection, $sql3);
      return "success";
    } catch (Exception $e) {
      return $e;
    }
  }

  function insertCoach($userId, $phone, $ign, $discord, $steam, $mmr, $primaryRole, $achievements, $timetable, $aboutMe, $securityQuestion, $answer) {
    $connection = dbConnection();
    $sql = "INSERT INTO coaches VALUES ('','$userId', '$phone', '$ign', '$discord', '$steam', '$mmr', '$primaryRole', '0', '$achievements', '$timetable', '$aboutMe', '../res/default.jpg', 'true', 'false')";
    $sql2 = "UPDATE login SET question='$securityQuestion', answer='$answer' WHERE userId='$userId'";
    try {
      mysqli_query($connection, $sql);
      mysqli_query($connection, $sql2);
      return "success";
    } catch (Exception $e) {
      return $e;
    }
  }

  function updateCoach($userId, $name, $phone, $ign, $discord, $steam, $mmr, $primaryRole, $achievements, $timetable, $aboutMe) {
    $connection = dbConnection();
    $sql = "UPDATE coaches SET phone='$phone', IGN='$ign', discord='$discord', steam='$steam', mmr='$mmr', primaryRole='$primaryRole', achievements='$achievements', timetable='$timetable', aboutMe='$aboutMe' WHERE userId='$userId'";
    $sql2 = "UPDATE users SET name='$name' WHERE userId='$userId'";
    try {
      mysqli_query($connection, $sql);
      mysqli_query($connection, $sql2);
      return "success";
    } catch (Exception $e) {
      return $e;
    }
  }

  function getCoachData($userId) {
    $connection = dbConnection();
    $sql = "SELECT name FROM users WHERE userId='$userId'";
    $sql2 = "SELECT * FROM coaches WHERE userId='$userId'";
    try {
      $result = mysqli_query($connection, $sql);
      $row = mysqli_fetch_assoc($result);
      $name = $row['name'];

      $result2 = mysqli_query($connection, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $phone = $row2['phone'];
      $ign = $row2['IGN'];
      $discord = $row2['discord'];
      $steam = $row2['steam'];
      $mmr = $row2['mmr'];
      $profilePicture = $row2['profilePicture'];
      $primaryRole = $row2['primaryRole'];
      $achievements = $row2['achievements'];
      $timetable = $row2['timetable'];
      $aboutMe = $row2['aboutMe'];
     
      class returnData {

      }
      $returnData = new returnData();
      $returnData->name = $name;
      $returnData->phone = $phone;
      $returnData->ign = $ign;
      $returnData->discord = $discord;
      $returnData->steam = $steam;
      $returnData->mmr = $mmr;
      $returnData->primaryRole = $primaryRole;
      $returnData->profilePicture = $profilePicture;
      $returnData->achievements = $achievements;
      $returnData->timetable = $timetable;
      $returnData->aboutMe = $aboutMe;

      return $returnData;

    } catch (Exception $e) {
      return $e;
    }
  }

  function insertPackage($userId, $packageName, $packagePrice, $packageDuration) {
    $connection = dbConnection();
    $sql = "INSERT INTO packages VALUES ('','$userId', '$packageName', '$packagePrice', '$packageDuration')";
    try {
      mysqli_query($connection, $sql);
      return "success";
    } catch (Exception $e) {
      return $e;
      // return $e->getMessage();
    }
  }

  function getPackageData($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM packages WHERE userId='$userId'";
    try {
      $result = mysqli_query($connection, $sql);
      $string = "<table border=\"1\" class=\"myTable\">
      <tr>
        <td class=\"package-header\">Package Name</td>
        <td class=\"package-header\">Package Price</td>
        <td class=\"package-header\">Package Duration</td>
        <td>Option</td>
      </tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $string = $string . "<tr>
        <td>".$row["packageName"]."</td>
        <td>".$row["packagePrice"]."</td>
        <td>".$row["packageDuration"]."</td>
        <td><button onclick=\"deletes(".$row["packageId"].")\">Delete</button></td>
      </tr>\n";
      }
      $string = $string . "</table>";
      return $string;
    } catch (Exception $e) {
      return $e;
    }
  }

  function justGetPackageData($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM packages WHERE userId='$userId'";
    try {
      $result = mysqli_query($connection, $sql);
      $string = "<table border=\"1\" class=\"myTable\">
      <tr>
        <td class=\"package-header\">Package Name</td>
        <td class=\"package-header\">Package Price</td>
        <td class=\"package-header\">Package Duration</td>
      </tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $string = $string . "<tr>
        <td>".$row["packageName"]."</td>
        <td>".$row["packagePrice"]."</td>
        <td>".$row["packageDuration"]."</td>
      </tr>\n";
      }
      $string = $string . "</table>";
      return $string;
    } catch (Exception $e) {
      return $e;
    }
  }

  function deletePackage($packageId) {
    $connection = dbConnection();
    $sql = "DELETE FROM packages WHERE packageId = '$packageId'";
    try {
      mysqli_query($connection, $sql);
      return "success";
    } catch (Exception $e) {
      return $e;
    }
  }

  function uploadImage($filedir,$userId) {
    $connection = dbConnection();
    $sql = "UPDATE coaches SET profilePicture='$filedir' WHERE userId='$userId'";
    try {
      mysqli_query($connection, $sql);
      return "success";
    } catch (Exception $e) {
      return $e;
    }
  }

  function getReviewsData($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM reviews WHERE userId='$userId'";
    try {
      $result = mysqli_query($connection, $sql);
      $string = "<table border=\"1\" class=\"myTable\">
      <tr>
        <td>Reviewer</td>
        <td>Review</td>
        <td>Featured?</td>
        <td>Option</td>
      </tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $reviewerId = $row['reviewerId'];
        $sql2 = "SELECT * FROM users WHERE userId='$reviewerId'";
        $result2 = mysqli_query($connection, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $reviewerName = $row2['userName'];
        $string = $string . "<tr>
        <td>".$reviewerName."</td>
        <td>".$row["review"]."</td>
        <td>".$row["featuredReview"]."</td>
        <td><button onclick=\"features(".$row["reviewId"].")\">feature?</button></td>
      </tr>\n";
      }
      $string = $string . "</table>";
      return $string;
    } catch (Exception $e) {
      return $e;
    }
  }

  function featureReview($reviewId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM reviews WHERE reviewId='$reviewId'";
    try {
      $result = mysqli_query($connection, $sql);
      $row = mysqli_fetch_assoc($result);
      $currentFeature = $row['featuredReview'];
      if ($currentFeature == "false") {
        $sql2 = "UPDATE reviews SET featuredReview = 'true' WHERE reviewId='$reviewId'";
        mysqli_query($connection, $sql2);
        return "success";
      }
      else if ($currentFeature == "true") {
        $sql2 = "UPDATE reviews SET featuredReview = 'false' WHERE reviewId='$reviewId'";
        mysqli_query($connection, $sql2);
        return "success";
      }
    } catch (Exception $e) {
      return $e;
    }
  }

  function justGetReviews($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM reviews WHERE userId='$userId' AND featuredReview='false'";
    try {
      $result = mysqli_query($connection, $sql);
      $string = "<table border=\"1\">
      <tr>
        <td>Reviewer</td>
        <td>Review</td>
      </tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $reviewerId = $row['reviewerId'];
        $sql2 = "SELECT * FROM users WHERE userId='$reviewerId'";
        $result2 = mysqli_query($connection, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $reviewerName = $row2['userName'];
        $string = $string . "<tr>
        <td>".$reviewerName."</td>
        <td>".$row["review"]."</td>
      </tr>\n";
      }
      $string = $string . "</table>";
      return $string;
    } catch (Exception $e) {
      return $e;
    }
  }

  function justGetFeaturedReviews($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM reviews WHERE userId='$userId' AND featuredReview='true'";
    try {
      $result = mysqli_query($connection, $sql);
      $string = "<table border=\"1\">
      <tr>
        <td>Reviewer</td>
        <td>Review</td>
      </tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $reviewerId = $row['reviewerId'];
        $sql2 = "SELECT * FROM users WHERE userId='$reviewerId'";
        $result2 = mysqli_query($connection, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $reviewerName = $row2['userName'];
        $string = $string . "<tr>
        <td>".$reviewerName."</td>
        <td>".$row["review"]."</td>
      </tr>\n";
      }
      $string = $string . "</table>";
      return $string;
    } catch (Exception $e) {
      return $e;
    }
  }

  function checkExistence($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM coaches WHERE userId='$userId'";
    try {
      $result = mysqli_query($connection, $sql);
      if ($row = mysqli_fetch_assoc($result)) {
        return true;
      }
      else {
        return false;
      }
    } catch (Exception $e) {
      return $e;
    }
  }

  function getTransactionData($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM coaches WHERE userId='$userId'";
    try {
      $sql5 = "SELECT * FROM users WHERE userId='$userId'";
      $result5 = mysqli_query($connection, $sql5);
      $row5 = mysqli_fetch_assoc($result5);
      $coachName = $row5['userName'];
      $result = mysqli_query($connection, $sql);
      $row3 = mysqli_fetch_assoc($result);
      $coachId = $row3['coachId'];
      $sql3 = "SELECT * FROM transactions WHERE coachId='$coachId'";
      $result3 = mysqli_query($connection, $sql3);
      $string = "<table border=\"1\">
      <tr>
        <td>From</td>
        <td>To</td>
        <td>Amount</td>
      </tr>";
      while ($row = mysqli_fetch_assoc($result3)) {
        $studentId = $row['studentId'];
        $sql2 = "SELECT * FROM students WHERE studentId='$studentId'";
        $result2 = mysqli_query($connection, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $studentUserId = $row2['userId'];
        $sql4 = "SELECT * FROM users WHERE userId='$studentUserId'";
        $result4 = mysqli_query($connection, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $studentName = $row4['userName'];
        $string = $string . "<tr>
        <td>".$studentName."</td>
        <td>".$coachName."</td>
        <td>".$row["amount"]."</td>
      </tr>\n";
      }
      $string = $string . "</table>";
      return $string;
    } catch (Exception $e) {
      return $e;
    }
  }

  function getWallet($userId) {
    $connection = dbConnection();
    $sql = "SELECT * FROM coaches WHERE userId='$userId'";
    try {
      $result = mysqli_query($connection, $sql);
      $row = mysqli_fetch_assoc($result);
      $wallet = $row['wallet'];
      return $wallet;
    } catch (Exception $e) {
      return $e;
    }
  }
?>