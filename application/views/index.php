


    <div id="wrapper">
		<div class="wrap_box">
			<?php
			if($list->num_rows > 0){
				?>
				<table>
					<tr>
						<td>
							<select onchange="selectState(this.options[this.selectedIndex].value)">
								<option value="-1">Select country</option>
								<?php
								foreach($list->result() as $listElement){
									?>
									<option value="<?php echo $listElement->id?>"><?php echo $listElement->country_name?></option>
									<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<select id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)">
								<option value="-1">Select state</option>
							</select>
							<span id="state_loader"></span>
						</td>
					</tr>
					
					<tr>
						<td>
							<select id="city_dropdown">
								<option value="-1">Select city</option>
							</select>
							<span id="city_loader"></span>
						</td>
					</tr>
				</table>
				<?php
			}else{
				echo 'No Country Name Found';
			}
			?>
				
		</div>
    </div>

    
