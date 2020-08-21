<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
			
			<?php
			include "config.php";
			$sql = "SELECT * FROM satting";
			$result = mysqli_query($conn ,$sql)or die("Query fail: footer satting");
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_assoc($result)){
					echo "<span>{$row["footer"]}</span>";
				}
			}
			
			
			
			?>
                
            </div>
        </div>
    </div>
</div>
</body>
</html>
<!--© Copyright 2019 News | Powered by <a href="http://www.yahoobaba.net/">Yahoo Baba</a>-->