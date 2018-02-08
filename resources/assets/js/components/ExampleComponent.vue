<template>
    <div class="container-fluid">
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        {{ z }}
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      props: ['z'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
