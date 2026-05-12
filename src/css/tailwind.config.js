module.exports = {
  theme: {
    extend: {
      typography: () => ({
        DEFAULT: {
          css: [
            {
              "--tw-prose-body": "theme(--color-black)",
              "--tw-prose-headings": "theme(--color-black)",
              "--tw-prose-links": "theme(--color-black)",
              "--tw-prose-bold": "theme(--color-black)",
              maxWidth: null,
              fontSize: "0.9375rem",
              lineHeight: "1.5",
              a: {
                fontWeight: "400",
                transition: "text-decoration-color 0.15s cubic-bezier(0.4, 0, 0.2, 1)",
                "@media (hover: hover)": {
                  "&:hover": {
                    textDecorationColor: "transparent",
                  },
                },
              },
              h1: {
                marginTop: "0",
                marginBottom: "0rem",
                fontFamily: "theme(--font-heading)",
                fontSize: "5.125rem",
                lineHeight: "1",
                fontWeight: "425",
                color: "theme(--color-blue)",
                "@media (width < theme(--breakpoint-md))": {
                  fontSize: "2.625rem",
                },
              },
              h2: {
                marginTop: "0rem",
                marginBottom: "1.25rem",
                fontFamily: "theme(--font-heading)",
                fontSize: "3.875rem",
                lineHeight: "1.1",
                fontWeight: "400",
                color: "theme(--color-blue)",
                "@media (width < theme(--breakpoint-md))": {
                  fontSize: "2rem",
                },
              },
              "h2.inline-compass::before": {
                content: '""',
                display: "inline-block",
                verticalAlign: "middle",
                marginRight: "0.5rem",
                marginBottom: "0.1em",
                width: "0.85em",
                height: "0.85em",
                backgroundImage: `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='68' height='68' fill='none' viewBox='0 0 68 68'%3E%3Cpath fill='%23222c78' d='M21.69 34.793 6.68 54.103l21.7-10.723 5.34 24.08 5.361-24.08zM43.38 24.08 48.741 0l-15.01 19.31 12.041 15.483 21.69-10.713H43.381'/%3E%3Cpath fill='%2387bd25' d='M60.772 54.103 18.71 0l5.381 24.09L0 24.08z'/%3E%3C/svg%3E")`,
                backgroundRepeat: "no-repeat",
                backgroundSize: "contain",
                backgroundPosition: "center",
              },
              h3: {
                marginTop: "0rem",
                marginBottom: "1.25rem",
                fontFamily: "theme(--font-heading)",
                fontSize: "2.625rem",
                lineHeight: "1.1",
                fontWeight: "400",
                color: "theme(--color-blue)",
                "@media (width < theme(--breakpoint-md))": {
                  fontSize: "1.625rem",
                },
              },
              "h3.inline-compass::before": {
                content: '""',
                display: "inline-block",
                verticalAlign: "middle",
                marginRight: "0.5rem",
                marginBottom: "0.1em",
                width: "0.85em",
                height: "0.85em",
                backgroundImage: `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='68' height='68' fill='none' viewBox='0 0 68 68'%3E%3Cpath fill='%23222c78' d='M21.69 34.793 6.68 54.103l21.7-10.723 5.34 24.08 5.361-24.08zM43.38 24.08 48.741 0l-15.01 19.31 12.041 15.483 21.69-10.713H43.381'/%3E%3Cpath fill='%2387bd25' d='M60.772 54.103 18.71 0l5.381 24.09L0 24.08z'/%3E%3C/svg%3E")`,
                backgroundRepeat: "no-repeat",
                backgroundSize: "contain",
                backgroundPosition: "center",
              },
              h4: {
                marginTop: "0rem",
                marginBottom: "1.25rem",
                fontFamily: "theme(--font-heading)",
                fontSize: "1.875rem",
                lineHeight: "1.1",
                fontWeight: "425",
                color: "theme(--color-blue)",
                "@media (width < theme(--breakpoint-md))": {
                  fontSize: "1.438rem",
                },
              },
              h5: {
                marginTop: "0rem",
                marginBottom: "1.25rem",
                fontFamily: "theme(--font-heading)",
                fontSize: "1.438rem",
                lineHeight: "1.1",
                fontWeight: "600",
                color: "theme(--color-blue)",
                "@media (width < theme(--breakpoint-md))": {
                  fontSize: "1.375rem",
                },
              },
              a: {
                color: "var(--color-blue)",
                fontWeight: "inherit",
                textDecoration: "underline",
                textDecorationThickness: "1px",
                textUnderlineOffset: "2px",
                transition: "text-decoration-thickness 0.2s ease",
                "&:hover": {
                  textDecorationThickness: "2px",
                },
              },
              ul: {
                paddingLeft: "0rem",
                marginTop: "0rem",
                display: "flex",
                flexDirection: "column",
                gap: "0rem",
              },
              "ul li": {
                paddingLeft: "1.5rem",
                position: "relative",
                marginBottom: "0.25rem",
                lineHeight: "165%",
              },
              "ul li::before": {
                content: '""',
                position: "absolute",
                left: "0",
                top: "0.5rem",
                width: "0.8rem",
                height: "0.8rem",
                backgroundColor: "var(--color-green)",
                borderRadius: "50%",
                backgroundImage: `url("data:image/svg+xml,%3Csvg viewBox='0 0 21 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M19.27 3.97L1.72998 0L6.79998 3.97L1.85998 7.95L19.27 3.97Z' fill='%23FFFFFF'/%3E%3C/svg%3E")`,
                backgroundRepeat: "no-repeat",
                backgroundPosition: "75% 45%",
                backgroundSize: "85%",
                transform: "rotate(-50deg)",
                display: "inline-block",
              },
              "ul.compass-blue li::before": {
                backgroundColor: "var(--color-blue)",
                backgroundImage: `url("data:image/svg+xml,%3Csvg viewBox='0 0 21 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M19.27 3.97L1.72998 0L6.79998 3.97L1.85998 7.95L19.27 3.97Z' fill='%2387BD25'/%3E%3C/svg%3E")`,
                backgroundRepeat: "no-repeat",
                borderRadius: "50%",
                transform: "rotate(-50deg)",
              },
              "ul li::marker": {
                color: "transparent",
              },
              "ul li ul": {
                paddingLeft: "1.3rem",
                marginTop: "0.5rem",
                listStyleType: "disc",
              },
              "ul li ul li": {
                paddingLeft: "0rem",
              },
              "ul li ul li::before": {
                content: "none",
              },
              "ul li ul li::marker": {
                color: "var(--color-green)",
                fontSize: "1.4rem",
                left: "0",
                marginLeft: "0",
              },
              "p,	li": {
                marginTop: "0rem",
                marginBottom: "0rem",
                fontFamily: "theme(--font-sans)",
                fontSize: "1.063rem",
                lineHeight: "1.65",
                fontWeight: "500",
                letterSpacing: "0.01rem",
                color: "theme(--color-black)",
              },
              "p:first-of-type": {
                marginBottom: "1.25rem",
              },
              "h1:has(+ h1), h2:has(+ h2), h3:has(+ h3), h4:has(+ h4)": {
                marginBottom: "0rem",
              },

              ".not-prose + *": {
                marginTop: "0",
              },
              "> :last-child": {
                marginBottom: "0px !important",
              },
            },
          ],
        },
        white: {
          css: [
            {
              "--tw-prose-body": "theme(--color-white)",
              "--tw-prose-headings": "theme(--color-white)",
              "--tw-prose-links": "theme(--color-white)",
              "--tw-prose-bold": "theme(--color-white)",
              "h1, h2, h3, p, li, strong": {
                color: "var(--color-white)",
              },
              "h2.inline-compass::before": {
                backgroundImage: `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='68' height='68' fill='none' viewBox='0 0 68 68'%3E%3Cpath fill='%23ffffff' d='M21.69 34.793 6.68 54.103l21.7-10.723 5.34 24.08 5.361-24.08zM43.38 24.08 48.741 0l-15.01 19.31 12.041 15.483 21.69-10.713H43.381'/%3E%3Cpath fill='%2387bd25' d='M60.772 54.103 18.71 0l5.381 24.09L0 24.08z'/%3E%3C/svg%3E")`,
              },
            },
          ],
        },
      }),
    },
  },
};
