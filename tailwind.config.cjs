module.exports = {
  content: [
    "./*.php",
    "./*.html",
    "./inc/**/*.php",
    "./template-parts/**/*.php",
    "./templates/**/*.html",
    "./parts/**/*.html", 
    "./patterns/**/*.php",
    "./src/js/**/*.js"
  ],
  theme: {
    screens: {
      'xs': '475px',
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
      '3xl': '1920px',
    },
    extend: {
      colors: {
        primary: {
          DEFAULT: "#0B5FFF",
          dark: "#0847BF",
          light: "#E6F2FF"
        },
        gray: {
          50: "#F9FAFB",
          100: "#F3F4F6",
          200: "#E5E7EB",
          300: "#D1D5DB",
          400: "#9CA3AF",
          500: "#6B7280",
          600: "#4B5563",
          700: "#374151",
          800: "#1F2937",
          900: "#111827"
        }
      },
      fontFamily: {
        sans: ["Manrope", "Inter", "system-ui", "sans-serif"]
      },
      fontSize: {
        'hero': ['100px', { lineHeight: '100%', fontWeight: '700', letterSpacing: '-2px' }],
        'hero-mobile': ['48px', { lineHeight: '110%', fontWeight: '700', letterSpacing: '-1px' }],
        'hero-tablet': ['64px', { lineHeight: '105%', fontWeight: '700', letterSpacing: '-1.5px' }],
        'section': ['2.5rem', { lineHeight: '1.2', fontWeight: '600' }],
        'section-mobile': ['1.875rem', { lineHeight: '1.25', fontWeight: '600' }],
        'section-tablet': ['2.25rem', { lineHeight: '1.2', fontWeight: '600' }]
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '128': '32rem'
      },
      maxWidth: {
        '2xl': '778px'
      },
      height: {
        'hero-mobile': '60vh',
        'hero-tablet': '70vh',
        'hero-desktop': '1117px'
      }
    }
  },
  plugins: []
};
