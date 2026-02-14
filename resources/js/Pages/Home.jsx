import React from 'react';
import SiteLayout from '@/Layouts/SiteLayout';
import HeroSection from '@/Components/Site/HeroSection';
import NewsSection from '@/Components/Site/NewsSection';
import StudentAssistanceSection from '@/Components/Site/StudentAssistanceSection';
import EventsSection from '@/Components/Site/EventsSection';
import CoursesSection from '@/Components/Site/Home/CoursesSection';

import { Head } from '@inertiajs/react';

const Home = ({ featured, posts, events, banners, coursesGraduacao, coursesPos }) => {
  return (
    <SiteLayout>
      <Head title="Home" />
      <HeroSection featured={featured} banners={banners} />
      <NewsSection posts={posts} />
      <CoursesSection coursesGraduacao={coursesGraduacao} coursesPos={coursesPos} />
      <EventsSection events={events} />
      <StudentAssistanceSection />
    </SiteLayout>
  );
};

export default Home;