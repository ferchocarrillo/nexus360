
<template>
    <select :name="name" :multiple="multiple">
        <slot></slot>
    </select>
</template>
<script>
import Select2 from "select2";
export default {
    props:['options','value','name','multiple','group','validation','minimumInput','ajax','data'],
    data(){
        return{
             
        }
    },
    mounted(){
        $.fn.select2.defaults.set("theme", "bootstrap4");
        $.fn.select2.defaults.set("width", "auto");
        $.fn.select2.defaults.set("dropdownAutoWidth", true);
        var vm = this;
        if(vm.ajax){
            var newOption = new Option(this.data.text, this.data.value, false, false);
            $(this.$el).select2({
                minimumInputLength: (this.minimumInput ? this.minimumInput :  0),
                ajax:{
                    type: vm.ajax.type,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:vm.ajax.url,
                    data:vm.ajax.data,
                    processResults: function (data) {
                        vm.$emit('searchData',data);
                        return {
                            results:$.map(data,function(item){
                                return {
                                    id: item.id,
                                    text: item.id + ' - ' + item.text
                                }
                            })
                        };
                    }
                }
            })
            .val(this.value)
            .append(newOption)
            .trigger('change')
            .on('change',function(){
                vm.$emit('input', $(this).val())
            })
            
            

        }else{

            $(this.$el).select2({
                // theme: 'bootstrap4',
                // width:'resolve',
                minimumInputLength: (this.minimumInput ? this.minimumInput :  0),
                data: this.options,
                multiple: this.multiple
            })
            .val(this.value)
            .trigger('change')
            .on('change',function(){
                // vm.$emit('input',this.value);
                vm.$emit('input', $(this).val())
            })
        }
    },
    watch:{
        validation:function(value){
            
            $(this.$el).removeClass('is-valid is-invalid')
            .addClass(value ? 'is-invalid':'');
            
        },
        value: function(value){
            $(this.$el).val(value)
            // .trigger('change');
        },
        options: function(options){ 
            $(this.$el).empty()
            .select2({
                // theme: 'bootstrap4',
                // width:'resolve',
                minimumInputLength: (this.minimumInput ? this.minimumInput :  0),
                data: options,
                multiple: this.multiple
            })
            .val('')
            .trigger('change')
        },

        destroyed: function(){
            $(this.$el).off().select2('destroy');
        }
    }
}
</script>