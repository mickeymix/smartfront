<?
include '../header.php';
?>

        <div class="content-wrapper row">
            
            <main class="main container" role="main">
                
	<div class="col-md-push-3 col-md-6 col-xs-12">
		<section class="login-page content">
            <section class="returning-customer">
                <header>
                    <h4>Customer Login</h4>
                </header>
                

<form id="returningCustomerForm" method="post" action="/Account">

    
    
    <div class="form-group">
        <input id="ReturnURL" name="ReturnURL" type="hidden" value="">
        <input data-val="true" data-val-required="The InModal field is required." id="InModal" name="InModal" type="hidden" value="False">
        <label for="UserName">Username/Email Address</label>
        <input class="form-control" data-val="true" data-val-required="Username/Email Address is required" id="UserName" name="UserName" type="text" value="">
        <span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span>
    </div>
    <div class="form-group">
        <label for="Password">Password</label>
        <input class="form-control" data-val="true" data-val-required="Password is required" id="Password" name="Password" type="password">
        <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
    </div>
    <a href="forgotpassword.html">Forgot your password?</a> |
				<a href="register.html">Create an Account</a>
    <div class="form-action clearfix">
        <input type="submit" class="btn btn-primary btn-lg pull-right" value="Login">
    </div>
</form>

            </section>
        </section>
	</div>

			</main>
        </div>
        
<?

include '../footer.php';
?>