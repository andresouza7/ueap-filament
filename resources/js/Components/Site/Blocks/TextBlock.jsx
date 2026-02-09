import React from 'react';

const TextBlock = ({ data }) => (
    <div
        className="article-body prose-custom text-lg leading-relaxed font-[480] mb-6 space-y-6 text-gray-800"
        dangerouslySetInnerHTML={{ __html: data.body || '' }}
    />
);

export default TextBlock;
