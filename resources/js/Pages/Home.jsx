import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import AlternativeHeroSection from '@/Components/Site/AlternativeHeroSection';
import NewsSection from '@/Components/Site/NewsSection';
import StudentAssistanceSection from '@/Components/Site/StudentAssistanceSection';
import EventsSection from '@/Components/Site/EventsSection';

import HeroSection from '@/Components/Site/HeroSection';

const Home = ({ featured, posts, events, banners }) => {
  return (
    <SiteLayout>
      {/* <HeroSection featured={featured} /> */}
      <AlternativeHeroSection featured={featured} banners={banners} />

      <NewsSection posts={posts} />
      <EventsSection events={events} />
      <StudentAssistanceSection />
    </SiteLayout>
  );
};

export default Home;