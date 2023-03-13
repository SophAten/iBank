<!DOCTYPE html>
<html>
    <body>

    
    <div class="my-container">

            <div class="button iconbutton" onclick="openForm()">
            
    </div>

    <div class="form-popup" id="myForm">
    <form class="form-container">
        <div id="wrapper">
                    <div id="menu">
                        <p class="welcome">Welcome</p>
                        <p class="logout" onclick="closeForm()"><a id="exit" href="#">X</a></p>
                    </div>
        
                    <div id="chatbox">
                        <p><b>User:</b> Hello, I need help withdrawing some funds</p>
                        
                        <p><b>Manager: </b> Hello Sir, I would gladly like to help, Can I please have the last 4 digits of your SSN to confirm that it is you?</p>
                        
                        <p><b>User: </b> **** </p>
                        
                        <p><b>Manager: </b> Thank You Sir, How much would you like to withdraw? </p>
                    </div>
                    
                    <form name="message">
                        <input name="usermsg" type="text" id="usermsg" />
                        <input name="submitmsg" type="button" id="submitmsg" value="Send" />
                    </form>
                </div>
                
    

    
    </form>
    </div>
    </body>
</html>

<script>
    function openForm() {
    document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
    }
</script>

<style>

  body {
    margin: 20px auto;
    font-family: "Arial";
    font-weight: 300;
  }
   
  input {
    font-family: "Arial";
  }
   
  #wrapper {
    margin: 0 auto;
    padding-bottom: 25px;
    background: #eee;
    width: 400px;
    max-width: 100%;
    border: 2px solid #212121;
    border-radius: 4px;
    margin: 0 auto;
  }
   
  #chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #fff;
    height: 300px;
    width: 300px;
    border: 1px solid #a7a7a7;
    overflow: auto;
    border-radius: 4px;
    border-bottom: 4px solid #a7a7a7;
  }
   
  #usermsg {
    flex: 1;
    border-radius: 4px;
    border: 1px solid #1e3d59;
    display: block;
    margin: 0 auto;
    
  }
   
  #submitmsg {
    background: #1e3d59;;
    color: white;
    padding: 5px;
    font-weight: bold;
    border-radius: 4px;
    display: block;
    margin: 0 auto;
  }
   
  #menu {
    padding: 15px 25px;
    display: flex;
  }
   
  #menu p.welcome {
    flex: 1;
  }
   
  #exit {
    color: white;
    background: #c62828;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
  }

    .form-popup {
    display: none;
    position: fixed;
    bottom: 0;
    right: 15px;
    border: 3px solid #f1f1f1;
    }


    .my-container{

        position:fixed;
        bottom:50px;
        right:50px;
        cursor:pointer;

    }
    .iconbutton{

        width:50px;
        height:50px;
        border-radius: 100%;
        background: #FF4F79;
        box-shadow: 10px 10px 5px #aaaaaa;

    }

    .button{

        width:60px;
        height:60px;
        background:#1e3d59;

    }

</style>

