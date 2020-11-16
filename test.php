<!DOCTYPE HTML>
<html lang = "en">
    <head>
        <title>Genearte/test secure_code</title>
        <meta charset = "UTF-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-md-center mb-5"> 
                <h1 style="text-align:center">Generate / Test Secure Code</h1>
            </div>
            <form action="" method="post" class="form" role="form">
                <div row style="display:flex;">
                    <div class="col-sm-4 col-lg-2 offset-lg-3 data-field-col">
                        <label for="key">Key</label>
                        <input type="text" class="form-control" name="key" id="key">
                    </div>
                    <div class="col-sm-4 col-lg-2 data-field-col">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" name="date" id="date">
                    </div>
                    <div class="col-sm-4 col-lg-2 data-field-col">
                        <label for="code">Secure Code</label>
                        <input type="text" class="form-control" name="code" id="code">
                    </div>
                </div>
                <div row>
                    <div class="col-sm-4 offset-lg-8 col-lg-1">
                        <button type="button" class="btn btn-primary">Generate Secure Code</button>
                    </div>
                </div>
            </form>
        </div>
    
    </body>
</html>
