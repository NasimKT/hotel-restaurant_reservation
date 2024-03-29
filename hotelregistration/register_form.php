<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <style>
        #success_message {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>

<body>
    <div class="container">
        <form class="well form-horizontal" action="registrations.php" method="post" id="contact_form" enctype="multipart/form-data">
            <fieldset>

                <!-- Form Name -->
                <legend>
                    <center>
                        <h2><b>Hotel Registration</b></h2>
                    </center>
                </legend><br>

                <!-- Text input for Hotel Name -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Hotel Name</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="name" placeholder="Hotel Name" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input for About -->
                <div class="form-group">
                    <label class="col-md-4 control-label">About Hotel</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"></i></span>
                            <textarea name="about" placeholder="About Hotel" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Text input for Image -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Image</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                            <input name="image" placeholder="Image" class="form-control" type="file">
                        </div>
                    </div>
                </div>

                <!-- Text input for Email -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Email</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="mail" placeholder="Email" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input for Phone -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Phone</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="phone" placeholder="Phone" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input for Room -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Room Count</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-bed"></i></span>
                            <input name="room" placeholder="No of rooms" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Select input for Food -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Food Facility</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-cutlery"></i></span>
                            <select name="food" class="form-control">
                                <option value="">Select Food Facility</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Success!.</div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4"><br>
                        <button type="submit" class="btn btn-warning">&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#contact_form').bootstrapValidator({
                    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        first_name: {
                            validators: {
                                stringLength: {
                                    min: 2,
                                },
                                notEmpty: {
                                    message: 'Please enter your First Name'
                                }
                            }
                        },
                        last_name: {
                            validators: {
                                stringLength: {
                                    min: 2,
                                },
                                notEmpty: {
                                    message: 'Please enter your Last Name'
                                }
                            }
                        },
                        user_name: {
                            validators: {
                                stringLength: {
                                    min: 8,
                                },
                                notEmpty: {
                                    message: 'Please enter your Username'
                                }
                            }
                        },
                        user_password: {
                            validators: {
                                stringLength: {
                                    min: 8,
                                },
                                notEmpty: {
                                    message: 'Please enter your Password'
                                }
                            }
                        },
                        confirm_password: {
                            validators: {
                                stringLength: {
                                    min: 8,
                                },
                                notEmpty: {
                                    message: 'Please confirm your Password'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter your Email Address'
                                },
                                emailAddress: {
                                    message: 'Please enter a valid Email Address'
                                }
                            }
                        },
                        contact_no: {
                            validators: {
                                stringLength: {
                                    min: 12,
                                    max: 12,
                                    notEmpty: {
                                        message: 'Please enter your Contact No.'
                                    }
                                }
                            },
                            department: {
                                validators: {
                                    notEmpty: {
                                        message: 'Please select your Department/Office'
                                    }
                                }
                            },
                        }
                    }
                })
                .on('success.form.bv', function(e) {
                    $('#success_message').slideDown({
                        opacity: "show"
                    }, "slow") // Do something ...
                    $('#contact_form').data('bootstrapValidator').resetForm();

                    // Prevent form submission
                    e.preventDefault();

                    // Get the form instance
                    var $form = $(e.target);

                    // Get the BootstrapValidator instance
                    var bv = $form.data('bootstrapValidator');

                    // Use Ajax to submit form data
                    $.post($form.attr('action'), $form.serialize(), function(result) {
                        console.log(result);
                    }, 'json');
                });
        });
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>