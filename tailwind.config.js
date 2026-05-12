// This site uses .container-fluid in place of .container

const rem = (px) => {
  return `${px / 16}rem`;
};

/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./index.php', './app/**/*.php', './resources/**/*.{php,vue,js}'],
  safelist: [
    {
      pattern: /^cp-/,
    },
    // Gravity Forms classes used in ConvertPro
    'gform_fields',
    'gfield',
    'input',
    // ConvertPro + Gravity Forms combined selectors
    'cp-popup-content',
    'cp-modal-body',
    'gform_wrapper',
    'gfield_consent_label',
    'gform_button',
  ],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      white: '#ffffff',
      black: '#000000',
      stone: '#F7F2EA',
      racecar: '#064F23',
      cactus: '#087323',
      lime: '#0F8C29',
      maize: '#F4D682',
      mizuna: '#09B064',
      woad: '#004969',
      verdigris: '#007076',
      turquoise: '#00A0CC',
      sapphire: '#002F71',
      lapis: '#2C2CB8',
      provence: '#2A6EEB',
      amethyst: '#70147D',
      tulip: '#AB2182',
      azalea: '#E52D87',
      cinnabar: '#CE242B',
      spice: '#E45313',
      ember: '#FF3500',
      orange: '#EC7404',
      'nutmeg-light': '#CE4B11',
      gold: '#FFA000',
      daisy: '#FDCA00',
      ocean: '#03364F',
      plum: '#4F005E',
      gray: '#4b5563',
    },
    extend: {
      screens: {
        '3xl': '1696px',
      },
      fontFamily: {
        display: 'Big Shoulders Display, serif',
        sans: 'Gellix, sans-serif',
        serif: 'Copernicus, Georgia, serif',
      },
      fontSize: {
        '8xl': rem(120),
        '7xl': rem(100),
        '6xl': rem(90),
        '5.5xl': rem(80),
        '5xl': rem(66),
        '4xl': rem(52),
        '3xl': rem(42),
        '2xl': rem(32),
        '1.5xl': rem(28),
        xl: rem(24),
        lg: rem(22),
        '2md': rem(20),
        md: rem(18),
        base: rem(16),
      },
      fontWeight: {
        book: 350,
      },
      lineHeight: {
        'extra-tight': 1.1,
        1.4: 1.4,
      },
      letterSpacing: {
        tight: '-0.03em',
      },
      rotate: {
        360: '360deg',
      },
      spacing: {
        0.75: rem(3),
        1.25: rem(5),
        1.75: rem(7),
        2.25: rem(9),
        2.75: rem(11),
        3.25: rem(13),
        3.75: rem(15),
        3.5: rem(14),
        4.5: rem(18),
        5.5: rem(22),
        6.5: rem(26),
        7.5: rem(30),
        12.5: rem(50),
        12.75: rem(51),
        15: rem(60),
        16.5: rem(66),
        16.75: rem(67),
        18.75: rem(75),
        25: rem(100),
        27.5: rem(110),
        30: rem(120),
        33.5: rem(67),
        38: rem(152),
        45: rem(180),
        50: rem(200),
        125: rem(500),
        150: rem(600),
        160: rem(640),
        200: rem(800),
        'carousel-overflow': 'calc(-1*(100vw-100%)/2-5rem)',
      },
      width: {
        '90vw': '90vw',
      },
      flexBasis: {
        92.5: rem(370),
      },
      minWidth: {
        10: rem(40),
      },
      maxWidth: {
        260: rem(260),
        344: rem(344),
        636: rem(636),
      },
      width: {
        '49%': '49%',
        '51%': '51%',
        260: rem(260),
        344: rem(344),
      },
      maxHeight: {
        171.25: rem(685),
        200: rem(800),
      },
      backgroundImage: {
        'fill-hover':
          'linear-gradient(0deg, rgba(112, 20, 125, 0.15) 0%, rgba(112, 20, 125, 0.15) 100%)',
        'fill-init':
          'linear-gradient(0deg, rgba(255, 255, 255, 100) 0%, rgba(255, 255, 255, 100) 100%)',
        'link-underline':
          'linear-gradient(to right, currentColor, currentColor)',
        check: 'url(@images/check.svg)',
        'chevron-down': 'url(@images/chevron-down.svg)',
        overlay:
          'linear-gradient(247deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.50) 100%), linear-gradient(0deg, rgba(79, 75, 75, 0.20) 0%, rgba(79, 75, 75, 0.20) 100%)',
      },
      backgroundSize: {
        none: 0,
        'link-init': '0 2px',
        'link-hover': '100% 2px',
      },
      backgroundPosition: {
        'position-underline': 'center 0.975em',
      },
      boxShadow: {
        nav: '0px 42px 50px 0px rgba(0, 0, 0, 0.15)',
        underline: '0 1px',
        card: '0px 5px 10px 0px rgba(0, 0, 0, 0.20)',
      },
      zIndex: {
        5: '5',
        infinity: '999',
      },
      borderRadius: {
        1: '1px',
        10: rem(10),
        card: rem(30),
        image: rem(80),
        10: '10px',
        'image-xl': rem(150),
      },
      aspectRatio: {
        card: '37/40',
        drawer: '99/80',
        'hero-card': '159/118',
        'hero-card-image': '276/360',
        '4/3': '4/3',
      },
    },
  },
  plugins: [],
};

export default config;
