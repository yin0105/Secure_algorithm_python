<!DOCTYPE HTML>
<html lang = "en">
    <head>
        <title>Genearte/check secure_code</title>
        <meta charset = "UTF-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <!-- <?php
        // function secure_code() 
        // {
        //     $ch = curl_init('secure_code.php');
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //     curl_setopt ($ch, CURLOPT_POST, 1);
        //     curl_setopt ($ch, CURLOPT_POSTFIELDS, "data=20201116&key=aa&convert=encode");
        //     $result = curl_exec($ch);
        //     curl_close ($ch);
        //     return $result;
        // }
        
    ?> -->
    <body>
        <div class="container">
            <div class="row justify-content-md-center mb-5"> 
                <h1 style="text-align:center">Generate / Check Secure Code</h1>
            </div>
            <form action="" method="post" class="form" role="form">
                <div row style="display:flex;">
                    <div class="col-sm-4 col-lg-6 offset-lg-3 data-field-col">
                        <label for="key">Key</label>
                        <input type="text" class="form-control" name="key" id="key">
                    </div>
                </div>
                <div row style="display:flex;"  class="my-3">
                    <div class="col-sm-4 col-lg-3 offset-lg-3 data-field-col">
                        <label for="date_1">Date</label>
                        <input type="text" class="form-control" name="date_1" id="date_1" placeholder="2020-07-07">
                    </div>
                    <div class="col-sm-4 col-lg-3 data-field-col">
                        <label for="code_1">Secure Code</label>
                        <input type="text" class="form-control" name="code_1" id="code_1" readonly>
                    </div>
                </div>
                <div row class="mb-4">
                    <div class="col-sm-4 offset-lg-6 col-lg-3" style="text-align:right">
                        <button type="button" class="btn btn-primary" id="btn_generate">Generate Secure Code</button>
                    </div>
                </div>

                <div row style="display:flex;"  class="my-3">
                    <div class="col-sm-4 col-lg-3 offset-lg-3 data-field-col">
                        <label for="code_2">Secure Code</label>
                        <input type="text" class="form-control" name="code_2" id="code_2">                        
                    </div>
                    <div class="col-sm-4 col-lg-3 data-field-col">
                        <label for="date_2">Date</label>
                        <input type="text" class="form-control" name="date_2" id="date_2" readonly>
                    </div>
                </div>
                <div row class="mb-5">
                    <div class="col-sm-4 offset-lg-6 col-lg-3" style="text-align:right">
                        <button type="button" class="btn btn-primary" id="btn_check">Check Secure Code</button>
                    </div>
                </div>
                
            </form>
        </div>
    </body>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script type="text/javascript">        
        $(document).ready(function(){  
            $("#btn_generate").on("click", function(){
                $key = $("#key").val();
                if ($key == "") {
                    alert("Enter Key Value.");
                    return;
                }
                $date = $("#date_1").val();
                if(!$date.match(/^[0-9]{4}-([0-9]{1}|[0-9]{2})-([0-9]{1}|[0-9]{2})$/g)) {
                    alert("Invalid Date Format.");
                    return;
                } 
                dd_arr = $date.split("-");
                dd_arr[1] = ("0" + dd_arr[1]).substr(-2);
                dd_arr[2] = ("0" + dd_arr[2]).substr(-2);
                $date = dd_arr.join("");
                console.log($date);

                $.ajax({
                    url: "secure_code.php?data=" + $date + "&key=" + $key + "&convert=encode",
                    type: "GET",
                    datatype: "text",
                    success: function (result) { 
                        $("#code_1").val(result);
                    },
                    error: function (error) {
                        console.log("API Error");
                    }       
                });
            });

            $("#btn_check").on("click", function(){
                $code = $("#code_2").val();
                if ($code.length != 16) {
                    alert("Invalid Secure Code.");
                    return;
                }
                $key = $("#key").val();
                $.ajax({
                    url: "secure_code.php?data=" + $code + "&key=" + $key + "&convert=decode",
                    type: "GET",
                    datatype: "text",
                    success: function (result) { 
                        $("#date_2").val(result);
                    },
                    error: function (error) {
                        console.log("API Error");
                    }       
                });
            });
        });
    </script>
</html>
