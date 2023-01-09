 
              <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                
           
                   
                <tbody>
                    <tr>
                        <td>Package Name:</td> 
                        <td>
                            <table class="table table-striped" style="">
                                <tbody> 
                            <?php
                            if(!empty($details['packageName']))
                            {
                                foreach($details['packageName'] as $key =>$title)
                                {
                                    ?>
                                    <tr>
                                        <?php echo $title ?>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "-";
                            }
                            ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td> Test Name:</td> 
                            <td>
                                
                                <table class="table table-striped" style="">
                                    <tbody> 
                                        <?php
                                        if(!empty($details['test']))
                                        {
                                            foreach($details['test'] as $key =>$title)
                                            {
                                                ?>
                                                <tr>
                                                    <?php echo $title ?>
                                                </tr>
                                            <?php
                                            }
                                        }
                                        else{
                                            echo "-";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name:</td> <td>{{ $details['first_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile:</td> <td>{{ $details['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $details['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Address:</td> <td>{{ $details['address'] }}</td>
                    </tr>
                    <tr>
                        <td>City:</td> <td>{{ $details['city'] }}</td>
                    </tr>
                    <tr>
                        <td>Area:</td> <td>{{ $details['area'] }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td> <td>{{ $details['date'] }}</td>
                    </tr>
                    <tr>
                        <td>Remark:</td> <td>{{ $details['remark'] }}</td>
                    </tr>
                 
                </tbody>
               
            </table>  