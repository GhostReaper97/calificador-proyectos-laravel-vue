<template>

    <!-- Modal -->
    <div class="modal fade" :id=id tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div :class="'modal-dialog ' + size" role="document">
            <div class="modal-content">
                <div style="color:white" class="modal-header bg-dark">
                    <h5 class="modal-title">{{ titulo }}</h5>
                        <button style="color:white" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <slot name="contenido"></slot>
                </div>
                <div style="color:white" class="modal-footer bg-dark">
                    <slot name="botones"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    
    props : [
        'id',
        'size',
        'titulo'
    ]

}
</script>

