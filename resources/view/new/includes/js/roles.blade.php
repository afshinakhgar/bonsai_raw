
<script type="text/javascript">
$(function(){

    var role_val = $('#current_roles').val();
    var RolesArr = role_val.split(',');
    optionVal = [];
    $('#roles option').each(function() {
        if($(this).val() != 0){
            optionVal.push($(this).val());
        }
    });

    // for(var i=0 ; i<RolesArr.length;i++){
    //     $('#role_item_'+RolesArr[i]).remove();
    // }
    // console.log('pp',RolesArr);

    var val_roles_store = '';
    $('#add_role').on('click',function (e) {
        e.preventDefault();
        e.stopPropagation();
        var role_val = $('#roles').find(":selected").val();
        var role_text = $('#roles').find(":selected").text();
        // alert(RolesArr.indexOf(role_val));


        if(RolesArr.indexOf(role_val) !== 0){
            RolesArr.push(role_val);
            $('#current_roles').val(RolesArr.toString());

            if(role_val !== '0'){
                $('#role_item_'+role_val).remove();
                $('#current_demo_roles').append('<span class="badge badge-warning" style="margin-right:5px">'+role_text+'</span>');
            }else {
                alert('first select a role');
            }
        }
       
       
    });



    $('.remove_role').on('click',function (e) {
        e.preventDefault();
        var self = this;

        var roleId = $(this).data('id');
        removeArrItem(RolesArr, roleId);
        RolesArr.remove(roleId);
        console.log(RolesArr);
        // RolesArr.push(RolesArr);

        $('#current_roles').val(RolesArr.toString());
        if(role_val !== '0' || role_val !== ''){
            $('#role_'+roleId).remove();

            $(this).remove();
        }else {
        }
    });



    function removeArrItem(array, item) {
        for(var i in array){
            if(array[i]==item){
                array.splice(i,1);
                break;
            }
        }
    }
});




Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};
</script>



