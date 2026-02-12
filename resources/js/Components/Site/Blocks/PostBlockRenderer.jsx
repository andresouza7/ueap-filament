import React from 'react';
import TextBlock from './TextBlock';
import QuoteBlock from './QuoteBlock';
import GalleryBlock from './GalleryBlock';

const PostBlockRenderer = ({ blocks }) => {
    if (!Array.isArray(blocks) || blocks.length === 0) return null;

    return (
        <div className="space-y-8">
            {blocks.map((block, idx) => {
                switch (block.type) {
                    case 'text':
                        return <TextBlock key={idx} data={block.data} />;
                    case 'quote':
                        return <QuoteBlock key={idx} data={block.data} />;
                    case 'image':
                    case 'gallery':
                        return <GalleryBlock key={idx} data={block.data} />;
                    default:
                        console.warn(`Unknown block type: ${block.type}`);
                        return null;
                }
            })}
        </div>
    );
};

export default PostBlockRenderer;
