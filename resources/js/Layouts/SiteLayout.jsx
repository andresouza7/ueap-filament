import React, { useState } from 'react';
import { usePage } from '@inertiajs/react';
import AIChatbot from '@/Components/Site/AIChatbot';
import TopBar from '@/Components/SiteLayout/TopBar';
import SearchModal from '@/Components/SiteLayout/SearchModal';
import NavBar from '@/Components/SiteLayout/NavBar';
import Footer from '@/Components/SiteLayout/Footer';

const SiteLayout = ({ children }) => {
    const { menus } = usePage().props;
    const [isMenuOpen, setIsMenuOpen] = useState(false);
    const [isSearchOpen, setIsSearchOpen] = useState(false);

    return (
        <div className="min-h-screen flex flex-col bg-white">
            <SearchModal isOpen={isSearchOpen} onClose={() => setIsSearchOpen(false)} />

            <TopBar onSearchOpen={() => setIsSearchOpen(true)} />

            <NavBar
                isMenuOpen={isMenuOpen}
                setIsMenuOpen={setIsMenuOpen}
                menus={menus}
                onSearchOpen={() => setIsSearchOpen(true)}
            />

            <main id="main-content" className="flex-1 w-full" role="main">
                {children}
            </main>

            <Footer />

            {/* <AIChatbot /> */}
        </div>
    );
};

export default SiteLayout;
