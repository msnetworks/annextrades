<?php include("includes/header.php");
   //print_r($_REQUEST['property']);
   
    ?>
<script type="text/javascript">
   function searchlist(id) {
     var currentDiv;
     currentDiv = document.getElementById(id);
     if (currentDiv != null) {
   currentDiv.style.display = 'none';
     }
   else{  
     currentDiv.style.display = 'block';
     }
   }
   
   function checkbox() {
   //alert("hai");
   var lengthcount=document.searching.maxvalue.value;
   //alert(lengthcount);
   var checkedcount=0;
   for(var i=0; i<lengthcount; i++) {
   var property = "property["+i+"]";
   
    var dom = document.getElementById(property);//alert(dom);
   if(dom.checked==true) {
   	checkedcount++;
   }
   }
   
   if(checkedcount < 1) {
   	alert("Select Atleast One product");
   	return false;
   }
    else if(checkedcount>3)
    {
    	alert("Select Maximum Three Products Only ");
   return false;	
    }
   }
   function compare(){
   //alert("hai");
   var result=checkbox();
   if(result == false) {
   return false;
   }
   else {
   
   document.searching.submit();
   }
   }
   function comp()
   {
   document.searching.Submit.readOnly=false;
   }
   
   function checking()
   {
   alert("You can't add contact to your Own Product");
   }
</script>
<div class="body-cont">
   <div class="body-cont1">
      <div class="body-leftcont">
         <div class="cate-cont">
            <div class="cate-heading"> <?php echo $browse; ?> </div>
            <?php include("includes/sidebar.php"); ?>
         </div>
         <?php // include("includes/innerside1.php"); ?>
      </div>
      <div class="body-right">
         <?php include("includes/menu.php"); ?>
         <div class="products-cate-cont" style="width:600px;">
            <div class="products-cate-heading"> <span> <?php echo $upcoming_trade; ?></span>
               <a href="tradeshow.php" style="padding-left:320px;"><strong><?php echo $add_new_trade; ?></strong></a>
            </div>
            <div style="border: solid 1px #CFCFCF;">
               <table border="0" cellspacing="0" cellpadding="0" style="width:600px;" >
                  <tr>
                     <td>
                        <table style="width:600px;" border="0" cellpadding="0" cellspacing="2">
                           <?PHP 
                              $pro_name=$_REQUEST["p_name"];
                              $country=$_REQUEST["country"];
                              $category=$_REQUEST["category"];
                              
                                $_SESSION['pro_name']=$pro_name;
                                $_SESSION['category']=$category;
                                $_SESSION['pro_name']=$country;
                              $toodate=date('Y-m-d');
                              
                              
                              if($country=='0')
                              {
                              $country="";
                              }
                              
                               
                              if($category=='0')
                              {
                              $category="";
                              }
                              
                              if($pro_name!="")
                              {
                               $q1 = " AND `show_name` like '%$pro_name%' ";
                              }
                              
                              if($country!="")
                              {
                               $q2 = " AND `location` = '$country' ";
                              }
                              
                              if($category!="")
                              {
                               $q3 = " AND `industry_focus` = '$category' ";
                              }
                              
                              
                              $query = $q1.$q2.$q3;
                               
                              $query =substr($query, 4);
                              
                              if($query!='')
                              {
                               $select = "SELECT * FROM `tbl_tradeshow` WHERE $query and status='1' and events_todate > '$toodate'";
                              }
                              else
                              {
                              $select="SELECT * FROM `tbl_tradeshow` where status='1' and NOW() BETWEEN `events_fromdate` AND `events_todate`";
                              }
                              
                              $strget="";
                              $rowsPerPage =10;
                              $query=mysqli_query($con,getPagingQuery($select, $rowsPerPage,$strget)) or die(mysqli_error($con)); 
                              $pagingLink = getPagingLink($select, $rowsPerPage,$strget); 
                              
                              
                                 if(mysqli_num_rows($query) > 0)
                                {
                                 while($fetch=mysqli_fetch_array($query))
                              	{ 
                              
                              
                                                        $image = $fetch['image'];
                              						   if($_SESSION['language']=='english')
                              {
                                $showname = $fetch['show_name'];
                              
                              }
                              else if($_SESSION['language']=='french')
                              {
                                $showname = $fetch['show_name_french'];
                              
                              }
                              else if($_SESSION['language']=='chinese')
                              {
                                $showname = $fetch['show_name_chinese'];
                              
                              }
                              else
                              {
                                $showname = $fetch['show_name_spanish'];
                              
                              }
                              						  //$showname = $fetch['show_name'];
                              						  $industry = $fetch['industry_focus'];
                              						 $fromdate = $fetch['events_fromdate']; 
                              						 $todate = $fetch['events_todate'];
                               						$from_time = $fetch['from_time'];
                              						$to_time = $fetch['to_time'];
                              						$exe1=strtotime($fromdate);
                              							
                              							
                              						$startDate = mktime (0,0,0,date("m",$exe1),date("d",$exe1),date("Y",$exe1));
                                                      $finishDate = $startDate + (168 * 60 * 60); 
                                                      
                              						 $res=date('F j, Y',$finishDate); 
                              						 
                              						 $ress = date('F j, Y', strtotime('+7 days'));
                              						
                              		
                              						  $businesstype = split(",",$fromdate);
                              		
                              			
                              						  $businesstype[0];
                              						  $businesstype[1];
                              						 $businesstype[2];
                              			 
                              						  $todate = $fetch['events_todate'];
                              						  
                              						  $dateto = split(",",$todate);
                              						  $dateto[0];
                              						  $dateto[1];
                              						  $dateto[2];
                              						  
                              						  $location = $fetch['location'];
                              						 $fromdate;
                              					
                               ?>
                           <tr>
                              <td>
                                 <table width="100%" cellpadding="4" cellspacing="4" >
                                    <tr>
                                       <?php
                                          //if($ress <= $fromdate)
                                          //{ 
                                          ?>
                                       <!--<td align="center" valign="top">&nbsp;</td>-->
                                       <?php
                                          //$j++;  }
                                            //else
                                            //{
                                            //}
                                            ?>
                                       <td width="24%" align="center"><?php
                                          if(($image != "")&&(file_exists("uploads/". $image)))
                                          {
                                          ?>
                                          <img src="<?php echo "uploads/". $image;?>" height="75" width="75"/>
                                          <?php
                                             }
                                             else
                                             {
                                             ?>
                                          <img src="images/img_noimg.jpg" height="75" width="75"/>
                                          <?php
                                             }
                                             ?>                            
                                       </td>
                                       <td width="76%" valign="top">
                                          <table width="76%">
                                             <tr>
                                               
                                                <td height="25">
												 <input type="hidden" value="<?php echo $fetch['show_id'];?>" name = "ids[]" />
												<a class="browse_intext" href="tradeshow_search.php?id=<?php echo $fetch['show_id'];?>"><strong><?php echo $showname; ?></strong></a>&nbsp;&nbsp;<?php echo $fetch['seller_updated_date']; ?></td>
                                             </tr>
                                             <tr>
                                                <td height="20" class="inTxtNormal"><?php echo $industry; ?></td>
                                             </tr>
                                             <tr>
                                                <td height="20" class="inTxtNormal">
                                                   <?php 
                                                      $fromdate_new=explode('-',$fromdate); 
                                                      echo $fromdate_new[2]."-".$fromdate_new[1]."-".$fromdate_new[0];
                                                      
                                                      echo "-".$traders_to."-";
                                                      $todate_new=explode('-',$todate); 
                                                      echo $todate_new[2]."-".$todate_new[1]."-".$todate_new[0];
                                                      ?><br />
                                                   <?php
                                                      echo "From ".$from_time."-to-".$to_time;
                                                      ?>
                                                </td>
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td height="2"></td>
                           </tr>
                           <?php
                              $i++;
                              }
                              }
                        else
                        {
                        
                          echo "<tr>";
                                     echo "<td align='center' valign='top' class='redbold'>No Trade Shows Found </td>";
                                     echo "</tr>";
                        }
                              ?> 
                        </table>
                     </td>
                  </tr>
                 
                  <tr>
                     <td>
					  <input type="hidden" value="<?PHP echo $i; ?>" name="maxvalue" />
                     <!--</tr><tr><td align="center"><?PHP echo $pagingLink;
                        echo "<br>";?></td>
                        </tr>-->
                     
						</td>
                  </tr>
               </table>
               <div><?PHP echo $pagingLink;
                  echo "<br>";?>
               </div>
            </div>
         </div>
<?php include("includes/innerside2.php"); ?>
      </div>
	  
	  
   </div>
</div>

<?PHP
   function getPagingQuery($sql, $itemPerPage = 5)
   {
   if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
   	$page = (int)$_GET['page'];
   } else {
   	$page = 1;
   }
   
   // start fetching from this row number
   $offset = ($page - 1) * $itemPerPage;
   
   return $sql . " LIMIT $offset, $itemPerPage";
   
   }
   function getPagingLink($sql, $itemPerPage = 5, $strGet)
   {
    global $con;
   $result        = mysqli_query($con,$sql) or die(mysqli_error($con));
   $pagingLink    = '';
   $totalResults  = mysqli_num_rows($result);
   	
   
    @$totalPages    = ceil($totalResults / $itemPerPage);
   
   	
   // how many link pages to show
   $numLinks      = 10;
   
   	
   // create the paging links only if we have more than one page of results
   if ($totalPages > 1) {
   
   	$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
   	
   	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {
   		$pageNumber = (int)$_GET['page'];
   	} else {
   		$pageNumber = 1;
   	}
   	
   	// print 'previous' link only if we're not
   	// on page one
   	if ($pageNumber > 1) {
   		$page = $pageNumber - 1;
   		if ($page > 1) {
   			$prev = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">| Prev |</a> ";
   		} else {
   			$prev = " <a href=\"$self?$strGet\" class=\"topics2\">| Prev |</a> ";
   		}	
   			
   		$first = " <a href=\"$self?$strGet\" class=\"topics2\"> First</a> ";
   	} else {
   		$prev  = ''; // we're on page one, don't show 'previous' link
   		$first = ''; // nor 'first page' link
   	}
   
   	// print 'next' link only if we're not
   	// on the last page
   	if ($pageNumber < $totalPages) {
   		$page = $pageNumber + 1;
   		$next = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">| Next</a> ";
   		$last = " <a href=\"$self?page=$totalPages&$strGet\" class=\"topics2\">| Last</a> ";
   	} else {
   		$next = ''; // we're on the last page, don't show 'next' link
   		$last = ''; // nor 'last page' link
   	}
   
   	$start = $pageNumber - ($pageNumber % $numLinks) + 1;
   	$end   = $start + $numLinks - 1;		
   	
   	$end   = min($totalPages, $end);
   	
   	$pagingLink = array();
   	for($page = $start; $page <= $end; $page++)	{
   		if ($page == $pageNumber) {
   		    
   			$pagingLink[] = " $page ";   // no need to create a link to current page
   		} else {
   			if ($page == 1) {
   			  
   				$pagingLink[] = " <a href=\"$self?$strGet\" class=\"topics2\">$page</a> ";
   			} else {	
   			 
   				$pagingLink[] = " <a href=\"$self?page=$page&$strGet\" class=\"topics2\">$page</a> ";
   			}	
   		}
   
   	}
   	
   	$pagingLink = implode(' | ', $pagingLink);
   	
   	// return the page navigation link
   	$pagingLink = $first . $prev . $pagingLink . $next . $last;
   	
   }
   
   
   return $pagingLink;
   }
   ?> 
<?php include("includes/footer.php"); ?>