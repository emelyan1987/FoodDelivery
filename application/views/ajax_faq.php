                                 
                                  <ul class="faqList">
                                       
                                        <?PHP
                                             foreach($faq_list as $ks=>$vs)
                                             {
                                         ?>

                                        <li>
                                            <div class="toggleDiv tabDiv<?PHP echo $vs->fid;  ?>" onClick="faq_tog(<?PHP echo $vs->fid;  ?>)">
                                                <img class="img-responsive" src="<?PHP echo base_url(); ?>assets/Customer/img/icon/smallLogoCss.png">
                                                <h4><?PHP echo $vs->title;  ?>?</h4>
                                                <p id="p<?PHP echo $vs->fid;  ?>"><?PHP echo $vs->description; ?></p>
                                            </div>
                                        </li>
                                        <?PHP
                                           }
                                        ?>
                                    </ul>