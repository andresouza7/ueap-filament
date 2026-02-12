import React, { useState, useRef } from 'react';
import { ChevronLeft, ChevronRight } from 'lucide-react';

const GalleryBlock = ({ data }) => {
    const images = Array.isArray(data.images) ? data.images : (data.path ? [data.path] : []); // Normalize images
    const [active, setActive] = useState(0);
    const sliderRef = useRef(null);

    const scrollTo = (index) => {
        if (sliderRef.current) {
            setActive(index);
            sliderRef.current.scrollTo({
                left: sliderRef.current.clientWidth * index,
                behavior: 'smooth'
            });
        }
    };

    if (!images.length) return null;

    return (
        <figure className="w-full flex flex-col mb-8">
            <div className="relative overflow-hidden aspect-video bg-white shadow-xl group">
                {/* Scrollable Container */}
                <div
                    ref={sliderRef}
                    className="flex h-full overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth"
                    onScroll={(e) => {
                        const index = Math.round(e.target.scrollLeft / e.target.clientWidth);
                        if (index !== active) setActive(index);
                    }}
                >
                    {images.map((src, idx) => (
                        <div key={idx} className="snap-center shrink-0 w-full h-full overflow-hidden">
                            <img
                                src={'/storage/' + src}
                                alt={`Imagem ${idx + 1}`}
                                className="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                            />
                        </div>
                    ))}
                </div>

                {/* Controls (if > 1 image) */}
                {images.length > 1 && (
                    <>
                        <div className="absolute inset-0 flex items-center justify-between px-4 pointer-events-none">
                            <button
                                onClick={() => scrollTo(active === 0 ? images.length - 1 : active - 1)}
                                className="pointer-events-auto bg-ueap-primary text-ueap-secondary p-2 rounded-full hover:bg-black transition-colors shadow-lg"
                            >
                                <ChevronLeft size={24} />
                            </button>
                            <button
                                onClick={() => scrollTo(active === images.length - 1 ? 0 : active + 1)}
                                className="pointer-events-auto bg-ueap-primary text-ueap-secondary p-2 rounded-full hover:bg-black transition-colors shadow-lg"
                            >
                                <ChevronRight size={24} />
                            </button>
                        </div>

                        {/* Dots */}
                        <div className="absolute bottom-4 left-0 w-full flex justify-center gap-2">
                            {images.map((_, idx) => (
                                <button
                                    key={idx}
                                    onClick={() => scrollTo(idx)}
                                    className={`h-2 rounded-full transition-all duration-300 ${active === idx ? 'w-8 bg-ueap-accent' : 'w-2 bg-white/60'}`}
                                />
                            ))}
                        </div>
                    </>
                )}
            </div>

            {/* Caption / Credits */}
            {(data.subtitle || data.credits) && (
                <figcaption className="mt-4 px-2 flex flex-col gap-1">
                    <div className="flex items-start gap-2">
                        <div className="h-4 w-1 bg-ueap-primary"></div>
                        <span className="text-[#002855] text-sm font-medium">
                            {data.subtitle || 'Galeria UEAP'}
                        </span>
                    </div>
                    {data.credits && (
                        <span className="text-sm font-bold text-contrast-body ml-3">
                            Foto: {data.credits}
                        </span>
                    )}
                </figcaption>
            )}
        </figure>
    );
};

export default GalleryBlock;
