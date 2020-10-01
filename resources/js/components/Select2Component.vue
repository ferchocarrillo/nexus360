
<template>
    <select :name="name" :multiple="multiple">
        <slot></slot>
    </select>
</template>
<script>
import Select2 from "select2";
export default {
    props:['options','value','name','multiple','group','validation'],
    data(){
        return{
             
        }
    },
    mounted(){
        $.fn.select2.defaults.set("theme", "bootstrap4");
        $.fn.select2.defaults.set("width", "auto");
        $.fn.select2.defaults.set("dropdownAutoWidth", true);
        var vm = this;
        $(this.$el).select2({
            // theme: 'bootstrap4',
            // width:'resolve',
            data: this.options,
            multiple: this.multiple
        })
        .val(this.value)
        .trigger('change')
        .on('change',function(){
            // vm.$emit('input',this.value);
             vm.$emit('input', $(this).val())
        })
    },
    watch:{
        validation:function(value){
            
            $(this.$el).removeClass('is-valid is-invalid')
            .addClass(value ? 'is-invalid':'');
            
        },
        value: function(value){
            $(this.$el).val(value).trigger('change');
        },
        options: function(options){ 
            $(this.$el).empty()
            .select2({
                // theme: 'bootstrap4',
                // width:'resolve',
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