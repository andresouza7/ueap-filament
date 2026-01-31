import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import AlternativeHeroSection from '@/Components/Site/AlternativeHeroSection';
import NewsSection from '@/Components/Site/NewsSection';
import StudentAssistanceSection from '@/Components/Site/StudentAssistanceSection';
import EventsSection from '@/Components/Site/EventsSection';

import QuickAccessSection from '@/Components/Site/QuickAccessSection';
import HeroSection from '@/Components/Site/HeroSection';

const Home = ({ featured, posts, events }) => {
  return (
    <SiteLayout>
      {/* <HeroSection featured={featured} /> */}
      <AlternativeHeroSection featured={featured} />
      <QuickAccessSection />
      <NewsSection posts={posts} />
      <StudentAssistanceSection />
      <EventsSection events={events} />
    </SiteLayout>
  );
};

export default Home;