<style lang="scss" >
</style>

<template>

<div class="row">
    <div class="col-md-4" v-for="item in items" :key="item.key">
        <div class="card mb-4 box-shadow">
            <img class="card-img-top" :src="item.image" alt="">
            <div class="card-body">
                <p class="card-text">{{ item.description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">{{ item.updated_at }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    name: "BoketeIndexCard",
    data() {
        return {
            items: [
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                },
                {
                    id: 0,
                    image: "https://via.placeholder.com/150",
                    description: "",
                    updated_at: ""
                }
            ]
        }
    },
    computed: {
        text() {
            return {}
        }
    }
}
</script>
