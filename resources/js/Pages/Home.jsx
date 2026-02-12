import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import HeroSection from '@/Components/Site/HeroSection';
import NewsSection from '@/Components/Site/NewsSection';
import StudentAssistanceSection from '@/Components/Site/StudentAssistanceSection';
import EventsSection from '@/Components/Site/EventsSection';

const Home = ({ featured, posts, events, banners }) => {
  return (
    <SiteLayout>
      {/* <HeroSection featured={featured} /> */}
      <HeroSection featured={featured} banners={banners} />

      <NewsSection posts={posts} />
      <EventsSection events={events} />
      <StudentAssistanceSection />
    </SiteLayout>
  );
};

export default Home;