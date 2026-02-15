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
      <Head>
        <title>UEAP - Home</title>
        <meta name="description" content="Universidade do Estado do Amapá - UEAP. Ensino, pesquisa e extensão para o desenvolvimento da Amazônia." />

        {/* Open Graph / Facebook */}
        <meta property="og:type" content="website" />
        <meta property="og:url" content={window.location.href} />
        <meta property="og:title" content="Universidade do Estado do Amapá - UEAP" />
        <meta property="og:description" content="Ensino, pesquisa e extensão para o desenvolvimento da Amazônia. Conheça nossos cursos de graduação, pós-graduação e projetos." />
        <meta property="og:image" content="https://ueap.edu.br/img/nova_logo_black.png" />

        {/* Twitter */}
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content={window.location.href} />
        <meta property="twitter:title" content="Universidade do Estado do Amapá - UEAP" />
        <meta property="twitter:description" content="Ensino, pesquisa e extensão para o desenvolvimento da Amazônia." />
        <meta property="twitter:image" content="https://ueap.edu.br/img/nova_logo_black.png" />
      </Head>
      <HeroSection featured={featured} banners={banners} />
      <NewsSection posts={posts} />
      <CoursesSection coursesGraduacao={coursesGraduacao} coursesPos={coursesPos} />
      <EventsSection events={events} />
      <StudentAssistanceSection />
    </SiteLayout>
  );
};

export default Home;