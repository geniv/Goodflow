<!doctype html>
<html ng-app>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
    <script type="text/javascript">
      function Ctrl(\$scope) {
        \$scope.userType = 'guest';
        /* , \$http
        \$http({
            method : 'POST',
            url : '/www/git/goodflow/layout_test/index.php',
            data : \$scope.user
        });
        */
      }
    </script>
  </head>
  
FIXME OMG neodesila post ani get? nejak vadne brani validace!

<body>
<form ng-controller="Ctrl" method="post" name="loginForm">
musi byt controler!!!!

    <legend>Create User</legend>

    <label>Name</label> 
    <input type="text" id="name" name="name" ng-model="user.name" placeholder="User Name" required> 

    <label>Email</label>
    <input type="text" id="email" name="email" ng-model="user.email" placeholder="ur email here"> 

    <label>Password</label>
    <input type="text" id="pwd" name="pwd" ng-model="user.pwd" placeholder="ur own pwd here">

    
    
    userType: <input name="input" ng-model="userType" required>
      <span class="error" ng-show="myForm.input.\$error.required">Required!</span><br>
    
      <tt>userType = {{userType}}</tt><br>
      <tt>loginForm.input.\$valid = {{loginForm.input.\$valid}}</tt><br>
      <tt>loginForm.input.\$error = {{loginForm.input.\$error}}</tt><br>
      <tt>loginForm.\$valid = {{loginForm.\$valid}}</tt><br>
      <tt>loginForm.\$error.required = {{!!loginForm.\$error.required}}</tt><br>

TEST: <input onclick="javascript:$(this).parent().submit();" type="submit" value="">

<input type="submit" class="btn btn-primary" name="sadasd"  value="Register" />
</form>



</body>

</html>