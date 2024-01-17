export default {
    getContentByUrl(url) {
        console.log(url);
        return axios.post(route('v1.content.url'), { url: url });
    }
};
