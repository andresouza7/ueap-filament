import React from 'react';

const VLibras = () => {
    const triggerVLibras = () => {
        const widget = document.querySelector('[vw-access-button]');
        if (widget) {
            widget.click();
        }
    };

    return (
        <>
            {/* Ocultar botão original do VLibras via style injetado */}
            <style>
                {`
                    [vw-access-button] {
                        display: none !important;
                    }
                `}
            </style>

            {/* Botão Customizado Flutuante - Design Exato do Blade */}
            <div
                onClick={triggerVLibras}
                className="fixed right-4 top-[65%] -translate-y-1/2 z-[9999] bg-white rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.15)] cursor-pointer overflow-hidden flex flex-col items-center border border-gray-100 w-11 transition-all duration-200 hover:-translate-y-[55%] hover:shadow-[0_6px_16px_rgba(0,0,0,0.2)]"
                title="Acessível em Libras"
                role="button"
                aria-label="Ativar VLibras"
            >
                <div className="p-[6px] flex justify-center items-center w-full text-[#003780]">
                    <i className="fa-solid fa-hands text-[20px]"></i>
                </div>
                <div className="bg-[#003780] text-white font-inter text-[7px] font-bold uppercase w-full text-center py-[3px] leading-none tracking-wide">
                    VLibras
                </div>
            </div>
        </>
    );
};

export default VLibras;
