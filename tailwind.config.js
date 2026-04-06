import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Primary - The Blue Trust
        primary: "#0037d0",
        'primary-container': "#1b4dff",
        
        // Semantic Colors
        secondary: "#1b6d24", // Growth (Income)
        tertiary: "#9d0012",  // Caution (Expense)
        
        // Neutral Surfaces (The Fiscal Sanctuary Palette)
        background: "#f8f9fa",
        surface: "#f8f9fa",
        'surface-container-lowest': "#ffffff", // For Hero Cards
        'surface-container-low': "#f1f3f5",
        'surface-container-high': "#e9ecef",
        
        // Text Colors
        'on-surface': "#191c1d",         // Headings
        'on-surface-variant': "#434656", // Secondary Labels
        
        // Accents
        'outline-variant': "rgba(196, 197, 217, 0.2)", // Ghost Borders
        'surface-tint': "rgba(11, 70, 249, 0.06)",     // Ambient Shadows
      },
      fontFamily: {
        'display': ['Manrope', 'sans-serif'], // For Headlines
        'sans': ['Inter', 'sans-serif'],      // For Body & Labels
      },
      borderRadius: {
        'xl': '1.5rem', // The Friendly Modern Look
        'md': '0.75rem', // For Inputs/Small Wells
      },
      boxShadow: {
        'ambient': '0 10px 50px 0 rgba(11, 70, 249, 0.06)', // The Soft Lift
      }
    },
  },
  plugins: [],
}
