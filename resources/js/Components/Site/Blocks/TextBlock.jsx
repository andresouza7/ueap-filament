import React from 'react';

const TextBlock = ({ data }) => (
    <div
        className="prose-custom text-lg leading-relaxed font-medium mb-6 space-y-6 text-[#002855]"
        dangerouslySetInnerHTML={{ __html: data.body || '' }}
    />
);

export default TextBlock;
