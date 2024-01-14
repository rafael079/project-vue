export default {
    store(data) {
        return axios.post(route('v1.posts.vote.store'), data)
    }
}
