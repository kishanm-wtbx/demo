<!DOCTYPE html>
<html>
<head>
    <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var code_verifier = Math.floor(Math.random()*1E16);
            

            $.ajax({
              "type": "GET",
              "url": "https://some.domain.com/oath/token",
              "headers": {
                "Accept": "application/json",
                "Authorization": "Basic " + btoa(username + ":" + password)
              },

              "data": {
                "grant_type": "client_credentials"
              },


              "success": function(response) {
                token = response.access_token;
                expiresIn = response.expires_in;
              },
              "error": function(errorThrown) {
                alert(JSON.stringify(errorThrown.error()));
              }
            });

        })
        
    </script>
</head>
<body>
    <?php 
        $code_verifier = random_int(1111111111111111, 9999999999999999);
        $hash_code = hash('sha256', $code_verifier);
        $code_challenge = $this->base64UrlEncode(pack('H*', $hash_code));
        $state = $code_verifier;
        $api_call_url = 'https://'.$subdomain.'.thinkific.com/oauth2/authorize?client_id='.$this->client_id.'&redirect_uri='.$this->redirect_uri.'&state='.$state.'&code_challenge='.$code_challenge.'&code_challenge_method=S256&response_type=code';
    ?>
</body>
</html>