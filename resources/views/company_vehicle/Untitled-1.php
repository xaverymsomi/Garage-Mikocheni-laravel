<tbody id="tbd">
                                                        <?php $i = 1; ?>
                                                    
                                                        <?php if ($obtale == []) {
                                                        ?>
                                                            <tr>
                                                                <?php echo "No Observation Found"; ?>
                                                            </tr>
                                                            <?php
                                                        } else {
                                                            foreach ($obtale as $datas) { ?>
                                                                <tr class="obs_point_data" id="<?php echo 'row_id_delete_' . $i; ?>">
                                                                    <td>
                                                                        <input type="text" name="product2[category][]" class="form-control" value="<?php echo $datas->job_cartegory_name; ?>" readonly="true">

                                                        <?php if ($data == []) {
                                                        ?>
                                                            <!-- <tr>
                                                                <td class="cname text-center" colspan="9">
                                                                    {{ trans('message.No data available in table.') }}
                                                                </td>
                                                            </tr> -->
                                                            <?php
                                                        } else {
                                                            foreach ($data as $datas) { ?>
                                                                <tr class="obs_point_data" id="<?php echo 'row_id_delete_' . $i; ?>">
                                                                    <td>
                                                                        <input type="text" name="product2[category][]" class="form-control" value="<?php echo $datas->checkout_subpoints; ?>" readonly="true">
                                                                        <input type="hidden" name="pro_id_delete" class="del_pro_<?php echo $i; ?>" id="del_pro_<?php echo $i; ?>" value="<?php echo $datas->id; ?>">
                                                                    </td>

                                                                    

                                            
                                                                    <td class="text-center">
                                                                        <i class="fa fa-trash fa-2x delete" style="cursor: pointer;" data_id_trash="<?php echo $i; ?>" delete_data_url=" <?php echo url('/jobcard/delete_on_reprocess'); ?>" service_id="<?php echo $viewid; ?>"></i>
                                                                        <input type="hidden" name="obs_id[]" class="form-control" value="<?php echo $datas->id; ?>">
                                                                    </td>
                                                                </tr>
                                                                <?php $i++;} ?>
                                                        <?php }
                                                        } ?>
                                                    </tbody>