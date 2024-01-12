import DOMPurify from 'dompurify';

const parseHtml = (html) => {
    const clean = DOMPurify.sanitize(html, {
        USE_PROFILES: { html: true }
    });
    return clean;
};

export { parseHtml };
