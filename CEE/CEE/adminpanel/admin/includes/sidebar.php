<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "cee_db";

$resultMessage = "";

try {
    $conn = new PDO("mysql:host={$host};dbname={$db};", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["answerId"])) {
    $answerId = $_POST["answerId"];

    try {
        $stmt = $conn->prepare("CALL examat_id(?, @exam_ans)");
        $stmt->bindParam(1, $answerId, PDO::PARAM_STR);
        $stmt->execute();

        $result = $conn->query("SELECT @exam_ans AS exam_ans");
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($row && isset($row["exam_ans"])) {
            $resultMessage = "Answer: " . $row["exam_ans"];
        } else {
            $resultMessage = "Answer not found";
        }
    } catch (PDOException $e) {
        $resultMessage = "Error: " . $e->getMessage();
    }
}
?>



   
   <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                  
          <!-- Result Display -->
         
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading"><a href="home.php">Dashboards</a></li>

                                <li class="app-sidebar__heading">MANAGE COURSE</li>
                                <li>
                                    <a href="#">
                                         <i class="metismenu-icon pe-7s-display2"></i>
                                         Course
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#modalForAddCourse">
                                                <i class="metismenu-icon"></i>
                                                Add Course
                                            </a>
                                        </li>
                                        <li>
                                            <a href="home.php?page=manage-course">
                                                <i class="metismenu-icon">
                                                </i>Manage Course
                                            </a>
                                            <div class="card mb-3">
                                            <div class="card-body">
 
                                            <div class="card-body">
    <h5 class="card-title">Find Answer</h5>
    <form id="findAnswerForm" method="post">
        <div class="form-group">
            <label for="answerId">Question ID:</label>
            <input type="text" class="form-control" id="answerId" name="answerId" required>
        </div>
        <button type="submit" class="btn btn-primary">Find</button>
    </form>
    <div id="result"><?php echo $resultMessage; ?></div> <!-- Display the result here -->
</div>

                                        </li>
                                       
                                    </ul>
                                </li>
                               
                                <li class="app-sidebar__heading">MANAGE EXAM</li>
                                <li>
                                    <a href="#">
                                         <i class="metismenu-icon pe-7s-display2"></i>
                                         Exam
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#modalForExam">
                                                <i class="metismenu-icon"></i>
                                                Add Exam
                                            </a>
                                        </li>
                                        <li>
                                            <a href="home.php?page=manage-exam">
                                                <i class="metismenu-icon">
                                                </i>Manage Exam
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li>
                           
                         
                                <li class="app-sidebar__heading">MANAGE EXAMINEE</li>
                                <li>
                                    <a href="" data-toggle="modal" data-target="#modalForAddExaminee">
                                        <i class="metismenu-icon pe-7s-add-user">
                                        </i>Add Examinee
                                    </a>
                                </li>
                                <li>
                                    <a href="home.php?page=manage-examinee">
                                        <i class="metismenu-icon pe-7s-users">
                                        </i>Manage Examinee
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">RANKING</li>
                                <li>
                                    <a href="home.php?page=ranking-exam">
                                        <i class="metismenu-icon pe-7s-cup">
                                        </i>Ranking By Exam
                                    </a>
                                </li>


                                <li class="app-sidebar__heading">REPORTS</li>
                                <li>
                                    <a href="home.php?page=examinee-result">
                                        <i class="metismenu-icon pe-7s-cup">
                                        </i>Examinee Result
                                    </a>
                                </li>
                              

                                 <li class="app-sidebar__heading">FEEDBACKS</li>
                                <li>
                                    <a href="home.php?page=feedbacks">
                                        <i class="metismenu-icon pe-7s-chat">
                                        </i>All Feedbacks
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>  

                


                // sidebar