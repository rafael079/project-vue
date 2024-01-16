export default {
    index(post_id) {
        return axios.get(
            route('v1.comments.getByPostId', { post_id: post_id })
        );
    }
};
