import * as Sentry from "@sentry/browser";

// check if sentry is defined
if (typeof Sentry === "undefined") {
	console.log("Sentry could not be loaded");
} else {
	Sentry.init({
		dsn: "https://76e6f4212d919fe3363ccd81c666262c@o4507430533791744.ingest.de.sentry.io/4508057886720080",
		integrations: [
			Sentry.replayIntegration({
				maskAllText: false,
				blockAllMedia: false,
			}),
		],
		// Session Replay
		replaysSessionSampleRate: 0.1, // This sets the sample rate at 10%. You may want to change it to 100% while in development and then sample at a lower rate in production.
		replaysOnErrorSampleRate: 1.0, // If you're not already sampling the entire session, change the sample rate to 100% when sampling sessions where errors occur.
	});
}
