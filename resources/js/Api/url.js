export default {
    getContentByUrl(url) {
        return axios.post(route('v1.content.url', { url: url }));
    }
};
