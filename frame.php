<?php
Class Frame
{
    function get_h()
    {
        $result = ' <div class="col-md-3">
                             <select name="status" class="form-control">
                                <option value="0" selected>один</option>
                                <option value="1" >два</option>
                                <option value="2" >три</option>
                                <option value="3" >четыре</option>
                                </select>
                                <input type="time" class="form-control">
                     </div>';
        return $result;
    }
}
?>