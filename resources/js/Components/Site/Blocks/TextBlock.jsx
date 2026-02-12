const TextBlock = ({ data }) => {
    // Wrap tables in a scrollable container to fix overflow issues
    const processedBody = (data.body || '').replace(
        /<table/g,
        '<div class="w-full overflow-x-auto mb-6"><table'
    ).replace(
        /<\/table>/g,
        '</table></div>'
    );

    return (
        <div
            className="article-body prose-custom mb-6 space-y-2"
            dangerouslySetInnerHTML={{ __html: processedBody }}
        />
    );
};

export default TextBlock;
