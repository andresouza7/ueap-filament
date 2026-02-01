import React from 'react';

const QuoteBlock = ({ data }) => (
    <div className="my-10 relative">
        <div className="absolute -top-4 -left-2 text-[#A3E635] text-7xl font-serif opacity-50">“</div>
        <blockquote className="bg-white border-l-[12px] border-[#0052CC] rounded-r-3xl p-8 shadow-md">
            <p className="text-[#002855] text-2xl font-black italic leading-tight">
                {data.text}
            </p>
        </blockquote>
    </div>
);

export default QuoteBlock;
