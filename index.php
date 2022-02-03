<?php
    // Designed and Built by Ross Skeels
    // NextLight Network Operations
    // 2022-02-2
    //
    // PHP7.4
    // MariaDB
    // Grafana

    $techNames = array("Ben","Dan","James","Jesse","Mike","Spencer");

    $dateTime = date("Y-m-d h:i:s");

    function validatePOST($postVar){
        global $validateError;
        if(isset($_POST[$postVar])){
            if($_POST[$postVar] === "0" || !empty($_POST[$postVar])){
                if(preg_match('/[0-9]/',htmlspecialchars($_POST[$postVar]))){
                    return true;
                }else{$validateError = "The value of '$postVar' is not valid!";}
            }else{$validateError = "Make sure no variables are empty! Try again.";}
        }else{$validateError = "Make sure all variables are set!";}
    }

    if(isset($_POST['submit']) && $_POST['submit'] === "Send It!"){
        if(validatePOST('eqptIssued')){
            echo "success";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>TSR Metrics</title>
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <style>
        body{
            background-color:#7eb9ae;
            color:white;
            margin:0;
            padding-bottom:4em;
            text-align:center;
        }
        main{
            background-color:#132e53;
            border-radius: 10px;
            margin:0 auto;
            min-width: 400px;
            padding:1px;
            width:70%;
        }
        main hr{
            margin-bottom:1em;
            width: 90%;
        }
        form hr{
            width:300px;
        }
        form h3{
            font-weight:bold;
            font-size:20px;
            text-decoration:underline;
        }
        .numBox{
            border-radius:1px;
            border-width:1px;
            padding:2px;
            width: 4em;
        }
        .question{
            padding-bottom:1em;
        }
        #submit{
            padding-bottom:1em;
        }
        #footer{
            /*background-color:#7eb9ae;*/
            background-image: linear-gradient(to right,#7eb9ae,#132e53,#7eb9ae);
            border-top:1px solid grey;
            bottom:0;
            margin:0;
            padding:3px 0;
            position:fixed;
            width:100%;
        }
        #footer p{
            margin: inherit;
        }
        .warning{
            color:red;
        }
    </style>
</head>
<body>
    <h1>TSR Metrics</h1>
    <main>
        <div>
            <p>Fill out the form below.</p>
            <p>If data is not available for a field, leave it as zero.</p>
        </div>
        <hr>
        <div>
            <p>Today's Date: <?php echo date("Y-m-d"); ?></p>
            <?php echo "<p class='warning'>$validateError</p>";?>
            <form action="/" method="POST">
                <!--<div class="question">
                    <label for="techName">Tech Name:</label>
                    <select id="techName" name="techName" required>
                        <option value="" selected disabled hidden>-</option>
                        <?php
                            foreach($techNames as $techName){
                                echo "<option value='$techName'>$techName</option>";
                            }
                        ?>
                    </select>
                </div>-->
                <hr>
                <h3>Equipment Handled</h3>
                <div class="question">
                    <label>Equipment Issued:</label>
                    <input type="number" min="0" max="99" class="numBox" id="eqptIssued" name="eqptIssued" placeholder="0-99" value="0" >
                </div>
                <div class="question">
                    <label>Equipment Cleaned:</label>
                    <input type="number" min="0" max="99" class="numBox" id="eqptCleaned" name="eqptCleaned" placeholder="0-99" value="0" required>
                </div>
                <hr>
                <h3>Orders Provisioned</h3>
                <div class="question">
                    <label>Next Day:</label>
                    <input type="number" min="0" max="99" class="numBox" id="ordersNextDay" name="ordersNextDay" placeholder="0-99" value="0" required>
                </div>
                <div class="question">
                    <label>Walk-In:</label>
                    <input type="number" min="0" max="99" class="numBox" id="ordersWalkIn" name="ordersWalkIn" placeholder="0-99" value="0" required>
                </div>
                <hr>
                <h3>Queue Calls</h3>
                <div class="question">
                    <label>Presented:</label>
                    <input type="number" min="0" max="99" class="numBox" id="callsPresented" name="callsPresented" placeholder="0-99" value="0" required>
                </div>
                <div class="question">
                    <label>Handled:</label>
                    <input type="number" min="0" max="99" class="numBox" id="callsHandled" name="callsHandled" placeholder="0-99" value="0" required>
                </div>
                <div class="question">
                    <label>Abandoned:</label>
                    <input type="number" min="0" max="99" class="numBox" id="callsAbandoned" name="callsAbandoned" placeholder="0-99" value="0" required>
                </div>
                <div class="question">
                    <label>Average Call Time:</label>
                    <input type="number" min="0" max="99" class="numBox" id="callsAvgTime" name="callsAvgTime" placeholder="0-99" value="0" required>
                </div>
                <hr>
                <h3>Other Communications</h3>
                <div class="question">
                    <label>Backline Calls:</label>
                    <input type="number" min="0" max="99" class="numBox" id="callsBackline" name="callsBackline" placeholder="0-99" value="0" required>
                </div>
                <div class="question">
                    <label>Email / IM:</label>
                    <input type="number" min="0" max="99" class="numBox" id="commsEmailIM" name="commsEmailIM" placeholder="0-99" value="0" required>
                </div>
                <div class="question">
                    <label>Voicemail:</label>
                    <input type="number" min="0" max="99" class="numBox" id="commsVM" name="commsVM" placeholder="0-99" value="0" required>
                </div>
                <hr>
                <p class="warning">It is crucial that the date is set to when the reported data occured.</p>
                <p class="warning">The data will be shown on the date that is reported below.</p>
                <div class="question">
                    <label>Date of results above:</label>
                    <input type="date" id="dataDate" name="dataDate" value=<?php echo $dateTime;?> required>
                </div>
                <div id="submit">
                    <input type="submit" name ="submit" value="Send It!">
                </div>
            </form>
        </div>
    </main>
    <div id="footer">
        <p>NextLight • <?php echo date("Y"); ?></p>
    </div>
</body>
</html>
