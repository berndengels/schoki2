<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Example Component</div>

                <div class="card-body">
                    I'm an example component.
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const Example = {
    name: 'Example',
    mounted() {
        console.log('Component mounted.')
    }
}
export default Example;
</script>
